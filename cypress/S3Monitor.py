import boto3
import json
import os
import quopri
import time
import re

mailbox_bucket = 'opg-lpa-casper-mailbox' # this might get renamed once casper tests are turned off
activation_emails_path = 'cypress/activation_emails'

def assume_role_and_get_client():
    sts = boto3.client(
        'sts',
        region_name='eu-west-1',
    )

    if os.getenv('CI'):
        print("Assuming CI role")
        role_arn = 'arn:aws:iam::050256574573:role/opg-lpa-ci'
    else:
        print("Assuming operator role")
        role_arn = 'arn:aws:iam::050256574573:role/operator'

    result = sts.assume_role(
        RoleArn=role_arn,
        RoleSessionName='session1',
    )

    s3Client = boto3.client(
        's3',
        aws_access_key_id=result['Credentials']['AccessKeyId'],
        aws_secret_access_key=result['Credentials']['SecretAccessKey'],
        aws_session_token=result['Credentials']['SessionToken']
    )

    return s3Client

# Extract the plus part from emails of the form:
# basename+pluspart@example.com
def getPlusPartFromEmailAddress(email):
    match = re.search("[^\+]\+(.+)@", email)
    if match is None:
        return ""
    return match.group(1)

def parseBody(bodyContent, subject, thetype, linkRegex):
    regex = 'https:\/\/\S+' + linkRegex + '\/[a-zA-Z0-9]+'

    match = re.search(regex, bodyContent)

    if match is not None: 
        s = match.start()
        e = match.end()
        activationLink = bodyContent[s:e]
        print(f'{ thetype } link { activationLink }')

        emailRegex = 'To: (.+)'

        emailMatch = re.search(emailRegex, bodyContent)
        if emailMatch is not None:
            es = emailMatch.start()
            ee = emailMatch.end()
            toEmail = bodyContent[es:ee]

            userId = getPlusPartFromEmailAddress(toEmail)
            print(f'userId {userId}')
            contents = f'{toEmail[:-1]},{activationLink}'
            filePath = f'{activation_emails_path}/{userId}.{thetype}'
            emailFile = open(filePath,'w')
            emailFile.write(contents)
            emailFile.close()
    else:
        print(f'Message: {subject} does not match regex {regex}') 
        print('----------------------------------------------------------------------------------')

def parse_email(bodyContent, s3Key):
    activate_subject = 'Activate your lasting power of attorney account'
    reset_password_subject = 'Password reset request'
    reset_password_no_account_subject = 'Request to reset password'  # this is the title for password resets where the account doesn't exist yet. We may need to test this too ultimately
    if re.search(activate_subject, bodyContent) is not None:
        return parseBody(bodyContent, activate_subject, 'activation', 'signup\/confirm')

    if re.search(reset_password_subject, bodyContent) is not None:
        return parseBody(bodyContent, reset_password_subject, 'passwordreset', 'forgot-password\/reset')

    if re.search(reset_password_no_account_subject, bodyContent) is not None:
        print("Found Password reset for a non-existent account. This shouldn't happen during tests, one explanation can be running password reset test before test that signs user up")
        return write_unrecognized_file(s3Key,bodyContent,'noaccountpasswordreset')

    # handle other emails. Ultimately, we should be testing these other emails as well
    print("Found an email that is not an Activate or Password reset. Don't know what to do with it")
    write_unrecognized_file(s3Key,bodyContent,'unrecognized')

def write_unrecognized_file(s3Key,bodyContent, filePrefix):
        fileSuffix = s3Key[s3Key.rfind('/')+1:]
        filePath = f'{activation_emails_path}/{filePrefix}.{fileSuffix}'
        emailFile = open(filePath,'w')
        emailFile.write(bodyContent)
        emailFile.close()

def process_bucket_object(s3Client,s3Key):
        result = s3Client.get_object(Bucket=mailbox_bucket,Key=s3Key)
        bodyContent = quopri.decodestring(result["Body"].read()).decode('latin-1')
        #print(f'Parsing {s3Key}')
        parse_email(bodyContent, s3Key)

def monitor_bucket(s3Client):
    seenkeys = []

    while True:
        #print('Checking S3')
        bucketContents = s3Client.list_objects(Bucket=mailbox_bucket)
        if 'Contents' in bucketContents:  # handle bucket being empty
            for s3obj in s3Client.list_objects(Bucket=mailbox_bucket)['Contents']:
                s3Key = s3obj['Key']
                if not s3Key in seenkeys:
                    process_bucket_object(s3Client,s3Key)
                    seenkeys.append(s3Key)
                #else:
                #    print(f'Already seen {s3Key}')
        time.sleep(5)


def main():
    s3Client = assume_role_and_get_client()
    monitor_bucket(s3Client)

if __name__ == "__main__":
    main()

