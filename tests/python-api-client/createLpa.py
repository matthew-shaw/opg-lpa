from lpaapi import *
import argparse
parser = argparse.ArgumentParser(description='Create a LPA via the API')
parser.add_argument('-hw', action='store_true',
                    default=False,
                    help='Choose Health and Welfare')
parser.add_argument('-d', action='store_true',
                    default=False,
                    help='Create Donor')
parser.add_argument('-a', action='store_true',
                    default=False,
                    help='Add attorneys')
args = parser.parse_args()

if args.hw :
    lpaType = 'health-and-welfare'
else:
    lpaType = 'property-and-financial'

lpaId = makeNewLpa()
setLpaType(lpaId, lpaType)
# if we specified donor, or we specified attorneys which implies we need a donor, then set the donor
if args.d or args.a:
    setDonor(lpaId)
    # this sets life-sustaining treatment to true
    setPrimaryAttorneyDecisions(lpaId, lpaType)
if args.a :
    addPrimaryAttorney(lpaId)
    addSecondPrimaryAttorney(lpaId)
    # this keeps life-sustaining treatment set to true and allows attorneys to act jointly
    setPrimaryAttorneyDecisionsMultipleAttorneys(lpaId, lpaType)
print(lpaId)
