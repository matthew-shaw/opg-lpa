<?php
// This file was auto-generated from sdk-root/src/data/cloudformation/2010-05-15/api-2.json
return [ 'version' => '2.0', 'metadata' => [ 'apiVersion' => '2010-05-15', 'endpointPrefix' => 'cloudformation', 'protocol' => 'query', 'serviceFullName' => 'AWS CloudFormation', 'signatureVersion' => 'v4', 'xmlNamespace' => 'http://cloudformation.amazonaws.com/doc/2010-05-15/', ], 'operations' => [ 'CancelUpdateStack' => [ 'name' => 'CancelUpdateStack', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'CancelUpdateStackInput', ], ], 'ContinueUpdateRollback' => [ 'name' => 'ContinueUpdateRollback', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ContinueUpdateRollbackInput', ], 'output' => [ 'shape' => 'ContinueUpdateRollbackOutput', 'resultWrapper' => 'ContinueUpdateRollbackResult', ], ], 'CreateStack' => [ 'name' => 'CreateStack', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'CreateStackInput', ], 'output' => [ 'shape' => 'CreateStackOutput', 'resultWrapper' => 'CreateStackResult', ], 'errors' => [ [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'AlreadyExistsException', ], [ 'shape' => 'InsufficientCapabilitiesException', ], ], ], 'DeleteStack' => [ 'name' => 'DeleteStack', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteStackInput', ], ], 'DescribeAccountLimits' => [ 'name' => 'DescribeAccountLimits', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeAccountLimitsInput', ], 'output' => [ 'shape' => 'DescribeAccountLimitsOutput', 'resultWrapper' => 'DescribeAccountLimitsResult', ], ], 'DescribeStackEvents' => [ 'name' => 'DescribeStackEvents', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeStackEventsInput', ], 'output' => [ 'shape' => 'DescribeStackEventsOutput', 'resultWrapper' => 'DescribeStackEventsResult', ], ], 'DescribeStackResource' => [ 'name' => 'DescribeStackResource', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeStackResourceInput', ], 'output' => [ 'shape' => 'DescribeStackResourceOutput', 'resultWrapper' => 'DescribeStackResourceResult', ], ], 'DescribeStackResources' => [ 'name' => 'DescribeStackResources', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeStackResourcesInput', ], 'output' => [ 'shape' => 'DescribeStackResourcesOutput', 'resultWrapper' => 'DescribeStackResourcesResult', ], ], 'DescribeStacks' => [ 'name' => 'DescribeStacks', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeStacksInput', ], 'output' => [ 'shape' => 'DescribeStacksOutput', 'resultWrapper' => 'DescribeStacksResult', ], ], 'EstimateTemplateCost' => [ 'name' => 'EstimateTemplateCost', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'EstimateTemplateCostInput', ], 'output' => [ 'shape' => 'EstimateTemplateCostOutput', 'resultWrapper' => 'EstimateTemplateCostResult', ], ], 'GetStackPolicy' => [ 'name' => 'GetStackPolicy', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetStackPolicyInput', ], 'output' => [ 'shape' => 'GetStackPolicyOutput', 'resultWrapper' => 'GetStackPolicyResult', ], ], 'GetTemplate' => [ 'name' => 'GetTemplate', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetTemplateInput', ], 'output' => [ 'shape' => 'GetTemplateOutput', 'resultWrapper' => 'GetTemplateResult', ], ], 'GetTemplateSummary' => [ 'name' => 'GetTemplateSummary', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetTemplateSummaryInput', ], 'output' => [ 'shape' => 'GetTemplateSummaryOutput', 'resultWrapper' => 'GetTemplateSummaryResult', ], ], 'ListStackResources' => [ 'name' => 'ListStackResources', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListStackResourcesInput', ], 'output' => [ 'shape' => 'ListStackResourcesOutput', 'resultWrapper' => 'ListStackResourcesResult', ], ], 'ListStacks' => [ 'name' => 'ListStacks', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListStacksInput', ], 'output' => [ 'shape' => 'ListStacksOutput', 'resultWrapper' => 'ListStacksResult', ], ], 'SetStackPolicy' => [ 'name' => 'SetStackPolicy', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'SetStackPolicyInput', ], ], 'SignalResource' => [ 'name' => 'SignalResource', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'SignalResourceInput', ], ], 'UpdateStack' => [ 'name' => 'UpdateStack', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'UpdateStackInput', ], 'output' => [ 'shape' => 'UpdateStackOutput', 'resultWrapper' => 'UpdateStackResult', ], 'errors' => [ [ 'shape' => 'InsufficientCapabilitiesException', ], ], ], 'ValidateTemplate' => [ 'name' => 'ValidateTemplate', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ValidateTemplateInput', ], 'output' => [ 'shape' => 'ValidateTemplateOutput', 'resultWrapper' => 'ValidateTemplateResult', ], ], ], 'shapes' => [ 'AccountLimit' => [ 'type' => 'structure', 'members' => [ 'Name' => [ 'shape' => 'LimitName', ], 'Value' => [ 'shape' => 'LimitValue', ], ], ], 'AccountLimitList' => [ 'type' => 'list', 'member' => [ 'shape' => 'AccountLimit', ], ], 'AllowedValue' => [ 'type' => 'string', ], 'AllowedValues' => [ 'type' => 'list', 'member' => [ 'shape' => 'AllowedValue', ], ], 'AlreadyExistsException' => [ 'type' => 'structure', 'members' => [], 'error' => [ 'code' => 'AlreadyExistsException', 'httpStatusCode' => 400, 'senderFault' => true, ], 'exception' => true, ], 'CancelUpdateStackInput' => [ 'type' => 'structure', 'required' => [ 'StackName', ], 'members' => [ 'StackName' => [ 'shape' => 'StackName', ], ], ], 'Capabilities' => [ 'type' => 'list', 'member' => [ 'shape' => 'Capability', ], ], 'CapabilitiesReason' => [ 'type' => 'string', ], 'Capability' => [ 'type' => 'string', 'enum' => [ 'CAPABILITY_IAM', ], ], 'ContinueUpdateRollbackInput' => [ 'type' => 'structure', 'required' => [ 'StackName', ], 'members' => [ 'StackName' => [ 'shape' => 'StackNameOrId', ], ], ], 'ContinueUpdateRollbackOutput' => [ 'type' => 'structure', 'members' => [], ], 'CreateStackInput' => [ 'type' => 'structure', 'required' => [ 'StackName', ], 'members' => [ 'StackName' => [ 'shape' => 'StackName', ], 'TemplateBody' => [ 'shape' => 'TemplateBody', ], 'TemplateURL' => [ 'shape' => 'TemplateURL', ], 'Parameters' => [ 'shape' => 'Parameters', ], 'DisableRollback' => [ 'shape' => 'DisableRollback', ], 'TimeoutInMinutes' => [ 'shape' => 'TimeoutMinutes', ], 'NotificationARNs' => [ 'shape' => 'NotificationARNs', ], 'Capabilities' => [ 'shape' => 'Capabilities', ], 'ResourceTypes' => [ 'shape' => 'ResourceTypes', ], 'OnFailure' => [ 'shape' => 'OnFailure', ], 'StackPolicyBody' => [ 'shape' => 'StackPolicyBody', ], 'StackPolicyURL' => [ 'shape' => 'StackPolicyURL', ], 'Tags' => [ 'shape' => 'Tags', ], ], ], 'CreateStackOutput' => [ 'type' => 'structure', 'members' => [ 'StackId' => [ 'shape' => 'StackId', ], ], ], 'CreationTime' => [ 'type' => 'timestamp', ], 'DeleteStackInput' => [ 'type' => 'structure', 'required' => [ 'StackName', ], 'members' => [ 'StackName' => [ 'shape' => 'StackName', ], ], ], 'DeletionTime' => [ 'type' => 'timestamp', ], 'DescribeAccountLimitsInput' => [ 'type' => 'structure', 'members' => [ 'NextToken' => [ 'shape' => 'NextToken', ], ], ], 'DescribeAccountLimitsOutput' => [ 'type' => 'structure', 'members' => [ 'AccountLimits' => [ 'shape' => 'AccountLimitList', ], 'NextToken' => [ 'shape' => 'NextToken', ], ], ], 'DescribeStackEventsInput' => [ 'type' => 'structure', 'members' => [ 'StackName' => [ 'shape' => 'StackName', ], 'NextToken' => [ 'shape' => 'NextToken', ], ], ], 'DescribeStackEventsOutput' => [ 'type' => 'structure', 'members' => [ 'StackEvents' => [ 'shape' => 'StackEvents', ], 'NextToken' => [ 'shape' => 'NextToken', ], ], ], 'DescribeStackResourceInput' => [ 'type' => 'structure', 'required' => [ 'StackName', 'LogicalResourceId', ], 'members' => [ 'StackName' => [ 'shape' => 'StackName', ], 'LogicalResourceId' => [ 'shape' => 'LogicalResourceId', ], ], ], 'DescribeStackResourceOutput' => [ 'type' => 'structure', 'members' => [ 'StackResourceDetail' => [ 'shape' => 'StackResourceDetail', ], ], ], 'DescribeStackResourcesInput' => [ 'type' => 'structure', 'members' => [ 'StackName' => [ 'shape' => 'StackName', ], 'LogicalResourceId' => [ 'shape' => 'LogicalResourceId', ], 'PhysicalResourceId' => [ 'shape' => 'PhysicalResourceId', ], ], ], 'DescribeStackResourcesOutput' => [ 'type' => 'structure', 'members' => [ 'StackResources' => [ 'shape' => 'StackResources', ], ], ], 'DescribeStacksInput' => [ 'type' => 'structure', 'members' => [ 'StackName' => [ 'shape' => 'StackName', ], 'NextToken' => [ 'shape' => 'NextToken', ], ], ], 'DescribeStacksOutput' => [ 'type' => 'structure', 'members' => [ 'Stacks' => [ 'shape' => 'Stacks', ], 'NextToken' => [ 'shape' => 'NextToken', ], ], ], 'Description' => [ 'type' => 'string', ], 'DisableRollback' => [ 'type' => 'boolean', ], 'EstimateTemplateCostInput' => [ 'type' => 'structure', 'members' => [ 'TemplateBody' => [ 'shape' => 'TemplateBody', ], 'TemplateURL' => [ 'shape' => 'TemplateURL', ], 'Parameters' => [ 'shape' => 'Parameters', ], ], ], 'EstimateTemplateCostOutput' => [ 'type' => 'structure', 'members' => [ 'Url' => [ 'shape' => 'Url', ], ], ], 'EventId' => [ 'type' => 'string', ], 'GetStackPolicyInput' => [ 'type' => 'structure', 'required' => [ 'StackName', ], 'members' => [ 'StackName' => [ 'shape' => 'StackName', ], ], ], 'GetStackPolicyOutput' => [ 'type' => 'structure', 'members' => [ 'StackPolicyBody' => [ 'shape' => 'StackPolicyBody', ], ], ], 'GetTemplateInput' => [ 'type' => 'structure', 'required' => [ 'StackName', ], 'members' => [ 'StackName' => [ 'shape' => 'StackName', ], ], ], 'GetTemplateOutput' => [ 'type' => 'structure', 'members' => [ 'TemplateBody' => [ 'shape' => 'TemplateBody', ], ], ], 'GetTemplateSummaryInput' => [ 'type' => 'structure', 'members' => [ 'TemplateBody' => [ 'shape' => 'TemplateBody', ], 'TemplateURL' => [ 'shape' => 'TemplateURL', ], 'StackName' => [ 'shape' => 'StackNameOrId', ], ], ], 'GetTemplateSummaryOutput' => [ 'type' => 'structure', 'members' => [ 'Parameters' => [ 'shape' => 'ParameterDeclarations', ], 'Description' => [ 'shape' => 'Description', ], 'Capabilities' => [ 'shape' => 'Capabilities', ], 'CapabilitiesReason' => [ 'shape' => 'CapabilitiesReason', ], 'ResourceTypes' => [ 'shape' => 'ResourceTypes', ], 'Version' => [ 'shape' => 'Version', ], 'Metadata' => [ 'shape' => 'Metadata', ], ], ], 'InsufficientCapabilitiesException' => [ 'type' => 'structure', 'members' => [], 'error' => [ 'code' => 'InsufficientCapabilitiesException', 'httpStatusCode' => 400, 'senderFault' => true, ], 'exception' => true, ], 'LastUpdatedTime' => [ 'type' => 'timestamp', ], 'LimitExceededException' => [ 'type' => 'structure', 'members' => [], 'error' => [ 'code' => 'LimitExceededException', 'httpStatusCode' => 400, 'senderFault' => true, ], 'exception' => true, ], 'LimitName' => [ 'type' => 'string', ], 'LimitValue' => [ 'type' => 'integer', ], 'ListStackResourcesInput' => [ 'type' => 'structure', 'required' => [ 'StackName', ], 'members' => [ 'StackName' => [ 'shape' => 'StackName', ], 'NextToken' => [ 'shape' => 'NextToken', ], ], ], 'ListStackResourcesOutput' => [ 'type' => 'structure', 'members' => [ 'StackResourceSummaries' => [ 'shape' => 'StackResourceSummaries', ], 'NextToken' => [ 'shape' => 'NextToken', ], ], ], 'ListStacksInput' => [ 'type' => 'structure', 'members' => [ 'NextToken' => [ 'shape' => 'NextToken', ], 'StackStatusFilter' => [ 'shape' => 'StackStatusFilter', ], ], ], 'ListStacksOutput' => [ 'type' => 'structure', 'members' => [ 'StackSummaries' => [ 'shape' => 'StackSummaries', ], 'NextToken' => [ 'shape' => 'NextToken', ], ], ], 'LogicalResourceId' => [ 'type' => 'string', ], 'Metadata' => [ 'type' => 'string', ], 'NextToken' => [ 'type' => 'string', 'max' => 1024, 'min' => 1, ], 'NoEcho' => [ 'type' => 'boolean', ], 'NotificationARN' => [ 'type' => 'string', ], 'NotificationARNs' => [ 'type' => 'list', 'member' => [ 'shape' => 'NotificationARN', ], 'max' => 5, ], 'OnFailure' => [ 'type' => 'string', 'enum' => [ 'DO_NOTHING', 'ROLLBACK', 'DELETE', ], ], 'Output' => [ 'type' => 'structure', 'members' => [ 'OutputKey' => [ 'shape' => 'OutputKey', ], 'OutputValue' => [ 'shape' => 'OutputValue', ], 'Description' => [ 'shape' => 'Description', ], ], ], 'OutputKey' => [ 'type' => 'string', ], 'OutputValue' => [ 'type' => 'string', ], 'Outputs' => [ 'type' => 'list', 'member' => [ 'shape' => 'Output', ], ], 'Parameter' => [ 'type' => 'structure', 'members' => [ 'ParameterKey' => [ 'shape' => 'ParameterKey', ], 'ParameterValue' => [ 'shape' => 'ParameterValue', ], 'UsePreviousValue' => [ 'shape' => 'UsePreviousValue', ], ], ], 'ParameterConstraints' => [ 'type' => 'structure', 'members' => [ 'AllowedValues' => [ 'shape' => 'AllowedValues', ], ], ], 'ParameterDeclaration' => [ 'type' => 'structure', 'members' => [ 'ParameterKey' => [ 'shape' => 'ParameterKey', ], 'DefaultValue' => [ 'shape' => 'ParameterValue', ], 'ParameterType' => [ 'shape' => 'ParameterType', ], 'NoEcho' => [ 'shape' => 'NoEcho', ], 'Description' => [ 'shape' => 'Description', ], 'ParameterConstraints' => [ 'shape' => 'ParameterConstraints', ], ], ], 'ParameterDeclarations' => [ 'type' => 'list', 'member' => [ 'shape' => 'ParameterDeclaration', ], ], 'ParameterKey' => [ 'type' => 'string', ], 'ParameterType' => [ 'type' => 'string', ], 'ParameterValue' => [ 'type' => 'string', ], 'Parameters' => [ 'type' => 'list', 'member' => [ 'shape' => 'Parameter', ], ], 'PhysicalResourceId' => [ 'type' => 'string', ], 'ResourceProperties' => [ 'type' => 'string', ], 'ResourceSignalStatus' => [ 'type' => 'string', 'enum' => [ 'SUCCESS', 'FAILURE', ], ], 'ResourceSignalUniqueId' => [ 'type' => 'string', 'max' => 64, 'min' => 1, ], 'ResourceStatus' => [ 'type' => 'string', 'enum' => [ 'CREATE_IN_PROGRESS', 'CREATE_FAILED', 'CREATE_COMPLETE', 'DELETE_IN_PROGRESS', 'DELETE_FAILED', 'DELETE_COMPLETE', 'DELETE_SKIPPED', 'UPDATE_IN_PROGRESS', 'UPDATE_FAILED', 'UPDATE_COMPLETE', ], ], 'ResourceStatusReason' => [ 'type' => 'string', ], 'ResourceType' => [ 'type' => 'string', ], 'ResourceTypes' => [ 'type' => 'list', 'member' => [ 'shape' => 'ResourceType', ], ], 'SetStackPolicyInput' => [ 'type' => 'structure', 'required' => [ 'StackName', ], 'members' => [ 'StackName' => [ 'shape' => 'StackName', ], 'StackPolicyBody' => [ 'shape' => 'StackPolicyBody', ], 'StackPolicyURL' => [ 'shape' => 'StackPolicyURL', ], ], ], 'SignalResourceInput' => [ 'type' => 'structure', 'required' => [ 'StackName', 'LogicalResourceId', 'UniqueId', 'Status', ], 'members' => [ 'StackName' => [ 'shape' => 'StackNameOrId', ], 'LogicalResourceId' => [ 'shape' => 'LogicalResourceId', ], 'UniqueId' => [ 'shape' => 'ResourceSignalUniqueId', ], 'Status' => [ 'shape' => 'ResourceSignalStatus', ], ], ], 'Stack' => [ 'type' => 'structure', 'required' => [ 'StackName', 'CreationTime', 'StackStatus', ], 'members' => [ 'StackId' => [ 'shape' => 'StackId', ], 'StackName' => [ 'shape' => 'StackName', ], 'Description' => [ 'shape' => 'Description', ], 'Parameters' => [ 'shape' => 'Parameters', ], 'CreationTime' => [ 'shape' => 'CreationTime', ], 'LastUpdatedTime' => [ 'shape' => 'LastUpdatedTime', ], 'StackStatus' => [ 'shape' => 'StackStatus', ], 'StackStatusReason' => [ 'shape' => 'StackStatusReason', ], 'DisableRollback' => [ 'shape' => 'DisableRollback', ], 'NotificationARNs' => [ 'shape' => 'NotificationARNs', ], 'TimeoutInMinutes' => [ 'shape' => 'TimeoutMinutes', ], 'Capabilities' => [ 'shape' => 'Capabilities', ], 'Outputs' => [ 'shape' => 'Outputs', ], 'Tags' => [ 'shape' => 'Tags', ], ], ], 'StackEvent' => [ 'type' => 'structure', 'required' => [ 'StackId', 'EventId', 'StackName', 'Timestamp', ], 'members' => [ 'StackId' => [ 'shape' => 'StackId', ], 'EventId' => [ 'shape' => 'EventId', ], 'StackName' => [ 'shape' => 'StackName', ], 'LogicalResourceId' => [ 'shape' => 'LogicalResourceId', ], 'PhysicalResourceId' => [ 'shape' => 'PhysicalResourceId', ], 'ResourceType' => [ 'shape' => 'ResourceType', ], 'Timestamp' => [ 'shape' => 'Timestamp', ], 'ResourceStatus' => [ 'shape' => 'ResourceStatus', ], 'ResourceStatusReason' => [ 'shape' => 'ResourceStatusReason', ], 'ResourceProperties' => [ 'shape' => 'ResourceProperties', ], ], ], 'StackEvents' => [ 'type' => 'list', 'member' => [ 'shape' => 'StackEvent', ], ], 'StackId' => [ 'type' => 'string', ], 'StackName' => [ 'type' => 'string', ], 'StackNameOrId' => [ 'type' => 'string', 'min' => 1, 'pattern' => '([a-zA-Z][-a-zA-Z0-9]*)|(arn:\\b(aws|aws-us-gov|aws-cn)\\b:[-a-zA-Z0-9:/._+]*)', ], 'StackPolicyBody' => [ 'type' => 'string', 'max' => 16384, 'min' => 1, ], 'StackPolicyDuringUpdateBody' => [ 'type' => 'string', 'max' => 16384, 'min' => 1, ], 'StackPolicyDuringUpdateURL' => [ 'type' => 'string', 'max' => 1350, 'min' => 1, ], 'StackPolicyURL' => [ 'type' => 'string', 'max' => 1350, 'min' => 1, ], 'StackResource' => [ 'type' => 'structure', 'required' => [ 'LogicalResourceId', 'ResourceType', 'Timestamp', 'ResourceStatus', ], 'members' => [ 'StackName' => [ 'shape' => 'StackName', ], 'StackId' => [ 'shape' => 'StackId', ], 'LogicalResourceId' => [ 'shape' => 'LogicalResourceId', ], 'PhysicalResourceId' => [ 'shape' => 'PhysicalResourceId', ], 'ResourceType' => [ 'shape' => 'ResourceType', ], 'Timestamp' => [ 'shape' => 'Timestamp', ], 'ResourceStatus' => [ 'shape' => 'ResourceStatus', ], 'ResourceStatusReason' => [ 'shape' => 'ResourceStatusReason', ], 'Description' => [ 'shape' => 'Description', ], ], ], 'StackResourceDetail' => [ 'type' => 'structure', 'required' => [ 'LogicalResourceId', 'ResourceType', 'LastUpdatedTimestamp', 'ResourceStatus', ], 'members' => [ 'StackName' => [ 'shape' => 'StackName', ], 'StackId' => [ 'shape' => 'StackId', ], 'LogicalResourceId' => [ 'shape' => 'LogicalResourceId', ], 'PhysicalResourceId' => [ 'shape' => 'PhysicalResourceId', ], 'ResourceType' => [ 'shape' => 'ResourceType', ], 'LastUpdatedTimestamp' => [ 'shape' => 'Timestamp', ], 'ResourceStatus' => [ 'shape' => 'ResourceStatus', ], 'ResourceStatusReason' => [ 'shape' => 'ResourceStatusReason', ], 'Description' => [ 'shape' => 'Description', ], 'Metadata' => [ 'shape' => 'Metadata', ], ], ], 'StackResourceSummaries' => [ 'type' => 'list', 'member' => [ 'shape' => 'StackResourceSummary', ], ], 'StackResourceSummary' => [ 'type' => 'structure', 'required' => [ 'LogicalResourceId', 'ResourceType', 'LastUpdatedTimestamp', 'ResourceStatus', ], 'members' => [ 'LogicalResourceId' => [ 'shape' => 'LogicalResourceId', ], 'PhysicalResourceId' => [ 'shape' => 'PhysicalResourceId', ], 'ResourceType' => [ 'shape' => 'ResourceType', ], 'LastUpdatedTimestamp' => [ 'shape' => 'Timestamp', ], 'ResourceStatus' => [ 'shape' => 'ResourceStatus', ], 'ResourceStatusReason' => [ 'shape' => 'ResourceStatusReason', ], ], ], 'StackResources' => [ 'type' => 'list', 'member' => [ 'shape' => 'StackResource', ], ], 'StackStatus' => [ 'type' => 'string', 'enum' => [ 'CREATE_IN_PROGRESS', 'CREATE_FAILED', 'CREATE_COMPLETE', 'ROLLBACK_IN_PROGRESS', 'ROLLBACK_FAILED', 'ROLLBACK_COMPLETE', 'DELETE_IN_PROGRESS', 'DELETE_FAILED', 'DELETE_COMPLETE', 'UPDATE_IN_PROGRESS', 'UPDATE_COMPLETE_CLEANUP_IN_PROGRESS', 'UPDATE_COMPLETE', 'UPDATE_ROLLBACK_IN_PROGRESS', 'UPDATE_ROLLBACK_FAILED', 'UPDATE_ROLLBACK_COMPLETE_CLEANUP_IN_PROGRESS', 'UPDATE_ROLLBACK_COMPLETE', ], ], 'StackStatusFilter' => [ 'type' => 'list', 'member' => [ 'shape' => 'StackStatus', ], ], 'StackStatusReason' => [ 'type' => 'string', ], 'StackSummaries' => [ 'type' => 'list', 'member' => [ 'shape' => 'StackSummary', ], ], 'StackSummary' => [ 'type' => 'structure', 'required' => [ 'StackName', 'CreationTime', 'StackStatus', ], 'members' => [ 'StackId' => [ 'shape' => 'StackId', ], 'StackName' => [ 'shape' => 'StackName', ], 'TemplateDescription' => [ 'shape' => 'TemplateDescription', ], 'CreationTime' => [ 'shape' => 'CreationTime', ], 'LastUpdatedTime' => [ 'shape' => 'LastUpdatedTime', ], 'DeletionTime' => [ 'shape' => 'DeletionTime', ], 'StackStatus' => [ 'shape' => 'StackStatus', ], 'StackStatusReason' => [ 'shape' => 'StackStatusReason', ], ], ], 'Stacks' => [ 'type' => 'list', 'member' => [ 'shape' => 'Stack', ], ], 'Tag' => [ 'type' => 'structure', 'members' => [ 'Key' => [ 'shape' => 'TagKey', ], 'Value' => [ 'shape' => 'TagValue', ], ], ], 'TagKey' => [ 'type' => 'string', ], 'TagValue' => [ 'type' => 'string', ], 'Tags' => [ 'type' => 'list', 'member' => [ 'shape' => 'Tag', ], ], 'TemplateBody' => [ 'type' => 'string', 'min' => 1, ], 'TemplateDescription' => [ 'type' => 'string', ], 'TemplateParameter' => [ 'type' => 'structure', 'members' => [ 'ParameterKey' => [ 'shape' => 'ParameterKey', ], 'DefaultValue' => [ 'shape' => 'ParameterValue', ], 'NoEcho' => [ 'shape' => 'NoEcho', ], 'Description' => [ 'shape' => 'Description', ], ], ], 'TemplateParameters' => [ 'type' => 'list', 'member' => [ 'shape' => 'TemplateParameter', ], ], 'TemplateURL' => [ 'type' => 'string', 'max' => 1024, 'min' => 1, ], 'TimeoutMinutes' => [ 'type' => 'integer', 'min' => 1, ], 'Timestamp' => [ 'type' => 'timestamp', ], 'UpdateStackInput' => [ 'type' => 'structure', 'required' => [ 'StackName', ], 'members' => [ 'StackName' => [ 'shape' => 'StackName', ], 'TemplateBody' => [ 'shape' => 'TemplateBody', ], 'TemplateURL' => [ 'shape' => 'TemplateURL', ], 'UsePreviousTemplate' => [ 'shape' => 'UsePreviousTemplate', ], 'StackPolicyDuringUpdateBody' => [ 'shape' => 'StackPolicyDuringUpdateBody', ], 'StackPolicyDuringUpdateURL' => [ 'shape' => 'StackPolicyDuringUpdateURL', ], 'Parameters' => [ 'shape' => 'Parameters', ], 'Capabilities' => [ 'shape' => 'Capabilities', ], 'ResourceTypes' => [ 'shape' => 'ResourceTypes', ], 'StackPolicyBody' => [ 'shape' => 'StackPolicyBody', ], 'StackPolicyURL' => [ 'shape' => 'StackPolicyURL', ], 'NotificationARNs' => [ 'shape' => 'NotificationARNs', ], ], ], 'UpdateStackOutput' => [ 'type' => 'structure', 'members' => [ 'StackId' => [ 'shape' => 'StackId', ], ], ], 'Url' => [ 'type' => 'string', ], 'UsePreviousTemplate' => [ 'type' => 'boolean', ], 'UsePreviousValue' => [ 'type' => 'boolean', ], 'ValidateTemplateInput' => [ 'type' => 'structure', 'members' => [ 'TemplateBody' => [ 'shape' => 'TemplateBody', ], 'TemplateURL' => [ 'shape' => 'TemplateURL', ], ], ], 'ValidateTemplateOutput' => [ 'type' => 'structure', 'members' => [ 'Parameters' => [ 'shape' => 'TemplateParameters', ], 'Description' => [ 'shape' => 'Description', ], 'Capabilities' => [ 'shape' => 'Capabilities', ], 'CapabilitiesReason' => [ 'shape' => 'CapabilitiesReason', ], ], ], 'Version' => [ 'type' => 'string', ], ],];
