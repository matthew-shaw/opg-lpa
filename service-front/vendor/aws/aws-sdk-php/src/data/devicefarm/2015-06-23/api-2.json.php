<?php
// This file was auto-generated from sdk-root/src/data/devicefarm/2015-06-23/api-2.json
return [ 'version' => '2.0', 'metadata' => [ 'apiVersion' => '2015-06-23', 'endpointPrefix' => 'devicefarm', 'jsonVersion' => '1.1', 'protocol' => 'json', 'serviceFullName' => 'AWS Device Farm', 'signatureVersion' => 'v4', 'targetPrefix' => 'DeviceFarm_20150623', ], 'operations' => [ 'CreateDevicePool' => [ 'name' => 'CreateDevicePool', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'CreateDevicePoolRequest', ], 'output' => [ 'shape' => 'CreateDevicePoolResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'CreateProject' => [ 'name' => 'CreateProject', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'CreateProjectRequest', ], 'output' => [ 'shape' => 'CreateProjectResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'CreateUpload' => [ 'name' => 'CreateUpload', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'CreateUploadRequest', ], 'output' => [ 'shape' => 'CreateUploadResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'DeleteDevicePool' => [ 'name' => 'DeleteDevicePool', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteDevicePoolRequest', ], 'output' => [ 'shape' => 'DeleteDevicePoolResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'DeleteProject' => [ 'name' => 'DeleteProject', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteProjectRequest', ], 'output' => [ 'shape' => 'DeleteProjectResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'DeleteRun' => [ 'name' => 'DeleteRun', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteRunRequest', ], 'output' => [ 'shape' => 'DeleteRunResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'DeleteUpload' => [ 'name' => 'DeleteUpload', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteUploadRequest', ], 'output' => [ 'shape' => 'DeleteUploadResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'GetAccountSettings' => [ 'name' => 'GetAccountSettings', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetAccountSettingsRequest', ], 'output' => [ 'shape' => 'GetAccountSettingsResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'GetDevice' => [ 'name' => 'GetDevice', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetDeviceRequest', ], 'output' => [ 'shape' => 'GetDeviceResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'GetDevicePool' => [ 'name' => 'GetDevicePool', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetDevicePoolRequest', ], 'output' => [ 'shape' => 'GetDevicePoolResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'GetDevicePoolCompatibility' => [ 'name' => 'GetDevicePoolCompatibility', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetDevicePoolCompatibilityRequest', ], 'output' => [ 'shape' => 'GetDevicePoolCompatibilityResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'GetJob' => [ 'name' => 'GetJob', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetJobRequest', ], 'output' => [ 'shape' => 'GetJobResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'GetProject' => [ 'name' => 'GetProject', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetProjectRequest', ], 'output' => [ 'shape' => 'GetProjectResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'GetRun' => [ 'name' => 'GetRun', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetRunRequest', ], 'output' => [ 'shape' => 'GetRunResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'GetSuite' => [ 'name' => 'GetSuite', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetSuiteRequest', ], 'output' => [ 'shape' => 'GetSuiteResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'GetTest' => [ 'name' => 'GetTest', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetTestRequest', ], 'output' => [ 'shape' => 'GetTestResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'GetUpload' => [ 'name' => 'GetUpload', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetUploadRequest', ], 'output' => [ 'shape' => 'GetUploadResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'ListArtifacts' => [ 'name' => 'ListArtifacts', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListArtifactsRequest', ], 'output' => [ 'shape' => 'ListArtifactsResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'ListDevicePools' => [ 'name' => 'ListDevicePools', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListDevicePoolsRequest', ], 'output' => [ 'shape' => 'ListDevicePoolsResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'ListDevices' => [ 'name' => 'ListDevices', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListDevicesRequest', ], 'output' => [ 'shape' => 'ListDevicesResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'ListJobs' => [ 'name' => 'ListJobs', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListJobsRequest', ], 'output' => [ 'shape' => 'ListJobsResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'ListProjects' => [ 'name' => 'ListProjects', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListProjectsRequest', ], 'output' => [ 'shape' => 'ListProjectsResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'ListRuns' => [ 'name' => 'ListRuns', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListRunsRequest', ], 'output' => [ 'shape' => 'ListRunsResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'ListSamples' => [ 'name' => 'ListSamples', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListSamplesRequest', ], 'output' => [ 'shape' => 'ListSamplesResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'ListSuites' => [ 'name' => 'ListSuites', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListSuitesRequest', ], 'output' => [ 'shape' => 'ListSuitesResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'ListTests' => [ 'name' => 'ListTests', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListTestsRequest', ], 'output' => [ 'shape' => 'ListTestsResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'ListUniqueProblems' => [ 'name' => 'ListUniqueProblems', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListUniqueProblemsRequest', ], 'output' => [ 'shape' => 'ListUniqueProblemsResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'ListUploads' => [ 'name' => 'ListUploads', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListUploadsRequest', ], 'output' => [ 'shape' => 'ListUploadsResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'ScheduleRun' => [ 'name' => 'ScheduleRun', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ScheduleRunRequest', ], 'output' => [ 'shape' => 'ScheduleRunResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'IdempotencyException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'UpdateDevicePool' => [ 'name' => 'UpdateDevicePool', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'UpdateDevicePoolRequest', ], 'output' => [ 'shape' => 'UpdateDevicePoolResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], 'UpdateProject' => [ 'name' => 'UpdateProject', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'UpdateProjectRequest', ], 'output' => [ 'shape' => 'UpdateProjectResult', ], 'errors' => [ [ 'shape' => 'ArgumentException', ], [ 'shape' => 'NotFoundException', ], [ 'shape' => 'LimitExceededException', ], [ 'shape' => 'ServiceAccountException', ], ], ], ], 'shapes' => [ 'AWSAccountNumber' => [ 'type' => 'string', 'max' => 16, 'min' => 2, ], 'AccountSettings' => [ 'type' => 'structure', 'members' => [ 'awsAccountNumber' => [ 'shape' => 'AWSAccountNumber', ], 'unmeteredDevices' => [ 'shape' => 'PurchasedDevicesMap', ], ], ], 'AmazonResourceName' => [ 'type' => 'string', 'min' => 32, ], 'AmazonResourceNames' => [ 'type' => 'list', 'member' => [ 'shape' => 'AmazonResourceName', ], ], 'ArgumentException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'Message', ], ], 'exception' => true, ], 'Artifact' => [ 'type' => 'structure', 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'name' => [ 'shape' => 'Name', ], 'type' => [ 'shape' => 'ArtifactType', ], 'extension' => [ 'shape' => 'String', ], 'url' => [ 'shape' => 'URL', ], ], ], 'ArtifactCategory' => [ 'type' => 'string', 'enum' => [ 'SCREENSHOT', 'FILE', 'LOG', ], ], 'ArtifactType' => [ 'type' => 'string', 'enum' => [ 'UNKNOWN', 'SCREENSHOT', 'DEVICE_LOG', 'MESSAGE_LOG', 'RESULT_LOG', 'SERVICE_LOG', 'WEBKIT_LOG', 'INSTRUMENTATION_OUTPUT', 'EXERCISER_MONKEY_OUTPUT', 'CALABASH_JSON_OUTPUT', 'CALABASH_PRETTY_OUTPUT', 'CALABASH_STANDARD_OUTPUT', 'CALABASH_JAVA_XML_OUTPUT', 'AUTOMATION_OUTPUT', 'APPIUM_SERVER_OUTPUT', 'APPIUM_JAVA_OUTPUT', 'APPIUM_JAVA_XML_OUTPUT', 'APPIUM_PYTHON_OUTPUT', 'APPIUM_PYTHON_XML_OUTPUT', 'EXPLORER_EVENT_LOG', 'EXPLORER_SUMMARY_LOG', 'APPLICATION_CRASH_REPORT', ], ], 'Artifacts' => [ 'type' => 'list', 'member' => [ 'shape' => 'Artifact', ], ], 'BillingMethod' => [ 'type' => 'string', 'enum' => [ 'METERED', 'UNMETERED', ], ], 'Boolean' => [ 'type' => 'boolean', ], 'CPU' => [ 'type' => 'structure', 'members' => [ 'frequency' => [ 'shape' => 'String', ], 'architecture' => [ 'shape' => 'String', ], 'clock' => [ 'shape' => 'Double', ], ], ], 'ContentType' => [ 'type' => 'string', 'max' => 64, 'min' => 0, ], 'Counters' => [ 'type' => 'structure', 'members' => [ 'total' => [ 'shape' => 'Integer', ], 'passed' => [ 'shape' => 'Integer', ], 'failed' => [ 'shape' => 'Integer', ], 'warned' => [ 'shape' => 'Integer', ], 'errored' => [ 'shape' => 'Integer', ], 'stopped' => [ 'shape' => 'Integer', ], 'skipped' => [ 'shape' => 'Integer', ], ], ], 'CreateDevicePoolRequest' => [ 'type' => 'structure', 'required' => [ 'projectArn', 'name', 'rules', ], 'members' => [ 'projectArn' => [ 'shape' => 'AmazonResourceName', ], 'name' => [ 'shape' => 'Name', ], 'description' => [ 'shape' => 'Message', ], 'rules' => [ 'shape' => 'Rules', ], ], ], 'CreateDevicePoolResult' => [ 'type' => 'structure', 'members' => [ 'devicePool' => [ 'shape' => 'DevicePool', ], ], ], 'CreateProjectRequest' => [ 'type' => 'structure', 'required' => [ 'name', ], 'members' => [ 'name' => [ 'shape' => 'Name', ], ], ], 'CreateProjectResult' => [ 'type' => 'structure', 'members' => [ 'project' => [ 'shape' => 'Project', ], ], ], 'CreateUploadRequest' => [ 'type' => 'structure', 'required' => [ 'projectArn', 'name', 'type', ], 'members' => [ 'projectArn' => [ 'shape' => 'AmazonResourceName', ], 'name' => [ 'shape' => 'Name', ], 'type' => [ 'shape' => 'UploadType', ], 'contentType' => [ 'shape' => 'ContentType', ], ], ], 'CreateUploadResult' => [ 'type' => 'structure', 'members' => [ 'upload' => [ 'shape' => 'Upload', ], ], ], 'DateTime' => [ 'type' => 'timestamp', ], 'DeleteDevicePoolRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], ], ], 'DeleteDevicePoolResult' => [ 'type' => 'structure', 'members' => [], ], 'DeleteProjectRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], ], ], 'DeleteProjectResult' => [ 'type' => 'structure', 'members' => [], ], 'DeleteRunRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], ], ], 'DeleteRunResult' => [ 'type' => 'structure', 'members' => [], ], 'DeleteUploadRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], ], ], 'DeleteUploadResult' => [ 'type' => 'structure', 'members' => [], ], 'Device' => [ 'type' => 'structure', 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'name' => [ 'shape' => 'Name', ], 'manufacturer' => [ 'shape' => 'String', ], 'model' => [ 'shape' => 'String', ], 'formFactor' => [ 'shape' => 'DeviceFormFactor', ], 'platform' => [ 'shape' => 'DevicePlatform', ], 'os' => [ 'shape' => 'String', ], 'cpu' => [ 'shape' => 'CPU', ], 'resolution' => [ 'shape' => 'Resolution', ], 'heapSize' => [ 'shape' => 'Long', ], 'memory' => [ 'shape' => 'Long', ], 'image' => [ 'shape' => 'String', ], 'carrier' => [ 'shape' => 'String', ], 'radio' => [ 'shape' => 'String', ], ], ], 'DeviceAttribute' => [ 'type' => 'string', 'enum' => [ 'ARN', 'PLATFORM', 'FORM_FACTOR', 'MANUFACTURER', ], ], 'DeviceFormFactor' => [ 'type' => 'string', 'enum' => [ 'PHONE', 'TABLET', ], ], 'DeviceMinutes' => [ 'type' => 'structure', 'members' => [ 'total' => [ 'shape' => 'Double', ], 'metered' => [ 'shape' => 'Double', ], 'unmetered' => [ 'shape' => 'Double', ], ], ], 'DevicePlatform' => [ 'type' => 'string', 'enum' => [ 'ANDROID', 'IOS', ], ], 'DevicePool' => [ 'type' => 'structure', 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'name' => [ 'shape' => 'Name', ], 'description' => [ 'shape' => 'Message', ], 'type' => [ 'shape' => 'DevicePoolType', ], 'rules' => [ 'shape' => 'Rules', ], ], ], 'DevicePoolCompatibilityResult' => [ 'type' => 'structure', 'members' => [ 'device' => [ 'shape' => 'Device', ], 'compatible' => [ 'shape' => 'Boolean', ], 'incompatibilityMessages' => [ 'shape' => 'IncompatibilityMessages', ], ], ], 'DevicePoolCompatibilityResults' => [ 'type' => 'list', 'member' => [ 'shape' => 'DevicePoolCompatibilityResult', ], ], 'DevicePoolType' => [ 'type' => 'string', 'enum' => [ 'CURATED', 'PRIVATE', ], ], 'DevicePools' => [ 'type' => 'list', 'member' => [ 'shape' => 'DevicePool', ], ], 'Devices' => [ 'type' => 'list', 'member' => [ 'shape' => 'Device', ], ], 'Double' => [ 'type' => 'double', ], 'ExecutionResult' => [ 'type' => 'string', 'enum' => [ 'PENDING', 'PASSED', 'WARNED', 'FAILED', 'SKIPPED', 'ERRORED', 'STOPPED', ], ], 'ExecutionStatus' => [ 'type' => 'string', 'enum' => [ 'PENDING', 'PROCESSING', 'SCHEDULING', 'RUNNING', 'COMPLETED', ], ], 'Filter' => [ 'type' => 'string', 'max' => 8192, 'min' => 0, ], 'GetAccountSettingsRequest' => [ 'type' => 'structure', 'members' => [], ], 'GetAccountSettingsResult' => [ 'type' => 'structure', 'members' => [ 'accountSettings' => [ 'shape' => 'AccountSettings', ], ], ], 'GetDevicePoolCompatibilityRequest' => [ 'type' => 'structure', 'required' => [ 'devicePoolArn', ], 'members' => [ 'devicePoolArn' => [ 'shape' => 'AmazonResourceName', ], 'appArn' => [ 'shape' => 'AmazonResourceName', ], 'testType' => [ 'shape' => 'TestType', ], ], ], 'GetDevicePoolCompatibilityResult' => [ 'type' => 'structure', 'members' => [ 'compatibleDevices' => [ 'shape' => 'DevicePoolCompatibilityResults', ], 'incompatibleDevices' => [ 'shape' => 'DevicePoolCompatibilityResults', ], ], ], 'GetDevicePoolRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], ], ], 'GetDevicePoolResult' => [ 'type' => 'structure', 'members' => [ 'devicePool' => [ 'shape' => 'DevicePool', ], ], ], 'GetDeviceRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], ], ], 'GetDeviceResult' => [ 'type' => 'structure', 'members' => [ 'device' => [ 'shape' => 'Device', ], ], ], 'GetJobRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], ], ], 'GetJobResult' => [ 'type' => 'structure', 'members' => [ 'job' => [ 'shape' => 'Job', ], ], ], 'GetProjectRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], ], ], 'GetProjectResult' => [ 'type' => 'structure', 'members' => [ 'project' => [ 'shape' => 'Project', ], ], ], 'GetRunRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], ], ], 'GetRunResult' => [ 'type' => 'structure', 'members' => [ 'run' => [ 'shape' => 'Run', ], ], ], 'GetSuiteRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], ], ], 'GetSuiteResult' => [ 'type' => 'structure', 'members' => [ 'suite' => [ 'shape' => 'Suite', ], ], ], 'GetTestRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], ], ], 'GetTestResult' => [ 'type' => 'structure', 'members' => [ 'test' => [ 'shape' => 'Test', ], ], ], 'GetUploadRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], ], ], 'GetUploadResult' => [ 'type' => 'structure', 'members' => [ 'upload' => [ 'shape' => 'Upload', ], ], ], 'IdempotencyException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'Message', ], ], 'exception' => true, ], 'IncompatibilityMessage' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'Message', ], 'type' => [ 'shape' => 'DeviceAttribute', ], ], ], 'IncompatibilityMessages' => [ 'type' => 'list', 'member' => [ 'shape' => 'IncompatibilityMessage', ], ], 'Integer' => [ 'type' => 'integer', ], 'Job' => [ 'type' => 'structure', 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'name' => [ 'shape' => 'Name', ], 'type' => [ 'shape' => 'TestType', ], 'created' => [ 'shape' => 'DateTime', ], 'status' => [ 'shape' => 'ExecutionStatus', ], 'result' => [ 'shape' => 'ExecutionResult', ], 'started' => [ 'shape' => 'DateTime', ], 'stopped' => [ 'shape' => 'DateTime', ], 'counters' => [ 'shape' => 'Counters', ], 'message' => [ 'shape' => 'Message', ], 'device' => [ 'shape' => 'Device', ], 'deviceMinutes' => [ 'shape' => 'DeviceMinutes', ], ], ], 'Jobs' => [ 'type' => 'list', 'member' => [ 'shape' => 'Job', ], ], 'LimitExceededException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'Message', ], ], 'exception' => true, ], 'ListArtifactsRequest' => [ 'type' => 'structure', 'required' => [ 'arn', 'type', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'type' => [ 'shape' => 'ArtifactCategory', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'ListArtifactsResult' => [ 'type' => 'structure', 'members' => [ 'artifacts' => [ 'shape' => 'Artifacts', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'ListDevicePoolsRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'type' => [ 'shape' => 'DevicePoolType', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'ListDevicePoolsResult' => [ 'type' => 'structure', 'members' => [ 'devicePools' => [ 'shape' => 'DevicePools', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'ListDevicesRequest' => [ 'type' => 'structure', 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'ListDevicesResult' => [ 'type' => 'structure', 'members' => [ 'devices' => [ 'shape' => 'Devices', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'ListJobsRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'ListJobsResult' => [ 'type' => 'structure', 'members' => [ 'jobs' => [ 'shape' => 'Jobs', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'ListProjectsRequest' => [ 'type' => 'structure', 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'ListProjectsResult' => [ 'type' => 'structure', 'members' => [ 'projects' => [ 'shape' => 'Projects', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'ListRunsRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'ListRunsResult' => [ 'type' => 'structure', 'members' => [ 'runs' => [ 'shape' => 'Runs', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'ListSamplesRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'ListSamplesResult' => [ 'type' => 'structure', 'members' => [ 'samples' => [ 'shape' => 'Samples', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'ListSuitesRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'ListSuitesResult' => [ 'type' => 'structure', 'members' => [ 'suites' => [ 'shape' => 'Suites', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'ListTestsRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'ListTestsResult' => [ 'type' => 'structure', 'members' => [ 'tests' => [ 'shape' => 'Tests', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'ListUniqueProblemsRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'ListUniqueProblemsResult' => [ 'type' => 'structure', 'members' => [ 'uniqueProblems' => [ 'shape' => 'UniqueProblemsByExecutionResultMap', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'ListUploadsRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'ListUploadsResult' => [ 'type' => 'structure', 'members' => [ 'uploads' => [ 'shape' => 'Uploads', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'Location' => [ 'type' => 'structure', 'required' => [ 'latitude', 'longitude', ], 'members' => [ 'latitude' => [ 'shape' => 'Double', ], 'longitude' => [ 'shape' => 'Double', ], ], ], 'Long' => [ 'type' => 'long', ], 'Message' => [ 'type' => 'string', 'max' => 8192, 'min' => 0, ], 'Metadata' => [ 'type' => 'string', 'max' => 8192, 'min' => 0, ], 'Name' => [ 'type' => 'string', 'max' => 256, 'min' => 0, ], 'NotFoundException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'Message', ], ], 'exception' => true, ], 'PaginationToken' => [ 'type' => 'string', 'max' => 1024, 'min' => 4, ], 'Problem' => [ 'type' => 'structure', 'members' => [ 'run' => [ 'shape' => 'ProblemDetail', ], 'job' => [ 'shape' => 'ProblemDetail', ], 'suite' => [ 'shape' => 'ProblemDetail', ], 'test' => [ 'shape' => 'ProblemDetail', ], 'device' => [ 'shape' => 'Device', ], 'result' => [ 'shape' => 'ExecutionResult', ], 'message' => [ 'shape' => 'Message', ], ], ], 'ProblemDetail' => [ 'type' => 'structure', 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'name' => [ 'shape' => 'Name', ], ], ], 'Problems' => [ 'type' => 'list', 'member' => [ 'shape' => 'Problem', ], ], 'Project' => [ 'type' => 'structure', 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'name' => [ 'shape' => 'Name', ], 'created' => [ 'shape' => 'DateTime', ], ], ], 'Projects' => [ 'type' => 'list', 'member' => [ 'shape' => 'Project', ], ], 'PurchasedDevicesMap' => [ 'type' => 'map', 'key' => [ 'shape' => 'DevicePlatform', ], 'value' => [ 'shape' => 'Integer', ], ], 'Radios' => [ 'type' => 'structure', 'members' => [ 'wifi' => [ 'shape' => 'Boolean', ], 'bluetooth' => [ 'shape' => 'Boolean', ], 'nfc' => [ 'shape' => 'Boolean', ], 'gps' => [ 'shape' => 'Boolean', ], ], ], 'Resolution' => [ 'type' => 'structure', 'members' => [ 'width' => [ 'shape' => 'Integer', ], 'height' => [ 'shape' => 'Integer', ], ], ], 'Rule' => [ 'type' => 'structure', 'members' => [ 'attribute' => [ 'shape' => 'DeviceAttribute', ], 'operator' => [ 'shape' => 'RuleOperator', ], 'value' => [ 'shape' => 'String', ], ], ], 'RuleOperator' => [ 'type' => 'string', 'enum' => [ 'EQUALS', 'LESS_THAN', 'GREATER_THAN', 'IN', 'NOT_IN', ], ], 'Rules' => [ 'type' => 'list', 'member' => [ 'shape' => 'Rule', ], ], 'Run' => [ 'type' => 'structure', 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'name' => [ 'shape' => 'Name', ], 'type' => [ 'shape' => 'TestType', ], 'platform' => [ 'shape' => 'DevicePlatform', ], 'created' => [ 'shape' => 'DateTime', ], 'status' => [ 'shape' => 'ExecutionStatus', ], 'result' => [ 'shape' => 'ExecutionResult', ], 'started' => [ 'shape' => 'DateTime', ], 'stopped' => [ 'shape' => 'DateTime', ], 'counters' => [ 'shape' => 'Counters', ], 'message' => [ 'shape' => 'Message', ], 'totalJobs' => [ 'shape' => 'Integer', ], 'completedJobs' => [ 'shape' => 'Integer', ], 'billingMethod' => [ 'shape' => 'BillingMethod', ], 'deviceMinutes' => [ 'shape' => 'DeviceMinutes', ], ], ], 'Runs' => [ 'type' => 'list', 'member' => [ 'shape' => 'Run', ], ], 'Sample' => [ 'type' => 'structure', 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'type' => [ 'shape' => 'SampleType', ], 'url' => [ 'shape' => 'URL', ], ], ], 'SampleType' => [ 'type' => 'string', 'enum' => [ 'CPU', 'MEMORY', 'THREADS', 'RX_RATE', 'TX_RATE', 'RX', 'TX', 'NATIVE_FRAMES', 'NATIVE_FPS', 'NATIVE_MIN_DRAWTIME', 'NATIVE_AVG_DRAWTIME', 'NATIVE_MAX_DRAWTIME', 'OPENGL_FRAMES', 'OPENGL_FPS', 'OPENGL_MIN_DRAWTIME', 'OPENGL_AVG_DRAWTIME', 'OPENGL_MAX_DRAWTIME', ], ], 'Samples' => [ 'type' => 'list', 'member' => [ 'shape' => 'Sample', ], ], 'ScheduleRunConfiguration' => [ 'type' => 'structure', 'members' => [ 'extraDataPackageArn' => [ 'shape' => 'AmazonResourceName', ], 'networkProfileArn' => [ 'shape' => 'AmazonResourceName', ], 'locale' => [ 'shape' => 'String', ], 'location' => [ 'shape' => 'Location', ], 'radios' => [ 'shape' => 'Radios', ], 'auxiliaryApps' => [ 'shape' => 'AmazonResourceNames', ], 'billingMethod' => [ 'shape' => 'BillingMethod', ], ], ], 'ScheduleRunRequest' => [ 'type' => 'structure', 'required' => [ 'projectArn', 'devicePoolArn', 'test', ], 'members' => [ 'projectArn' => [ 'shape' => 'AmazonResourceName', ], 'appArn' => [ 'shape' => 'AmazonResourceName', ], 'devicePoolArn' => [ 'shape' => 'AmazonResourceName', ], 'name' => [ 'shape' => 'Name', ], 'test' => [ 'shape' => 'ScheduleRunTest', ], 'configuration' => [ 'shape' => 'ScheduleRunConfiguration', ], ], ], 'ScheduleRunResult' => [ 'type' => 'structure', 'members' => [ 'run' => [ 'shape' => 'Run', ], ], ], 'ScheduleRunTest' => [ 'type' => 'structure', 'required' => [ 'type', ], 'members' => [ 'type' => [ 'shape' => 'TestType', ], 'testPackageArn' => [ 'shape' => 'AmazonResourceName', ], 'filter' => [ 'shape' => 'Filter', ], 'parameters' => [ 'shape' => 'TestParameters', ], ], ], 'ServiceAccountException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'Message', ], ], 'exception' => true, ], 'String' => [ 'type' => 'string', ], 'Suite' => [ 'type' => 'structure', 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'name' => [ 'shape' => 'Name', ], 'type' => [ 'shape' => 'TestType', ], 'created' => [ 'shape' => 'DateTime', ], 'status' => [ 'shape' => 'ExecutionStatus', ], 'result' => [ 'shape' => 'ExecutionResult', ], 'started' => [ 'shape' => 'DateTime', ], 'stopped' => [ 'shape' => 'DateTime', ], 'counters' => [ 'shape' => 'Counters', ], 'message' => [ 'shape' => 'Message', ], 'deviceMinutes' => [ 'shape' => 'DeviceMinutes', ], ], ], 'Suites' => [ 'type' => 'list', 'member' => [ 'shape' => 'Suite', ], ], 'Test' => [ 'type' => 'structure', 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'name' => [ 'shape' => 'Name', ], 'type' => [ 'shape' => 'TestType', ], 'created' => [ 'shape' => 'DateTime', ], 'status' => [ 'shape' => 'ExecutionStatus', ], 'result' => [ 'shape' => 'ExecutionResult', ], 'started' => [ 'shape' => 'DateTime', ], 'stopped' => [ 'shape' => 'DateTime', ], 'counters' => [ 'shape' => 'Counters', ], 'message' => [ 'shape' => 'Message', ], 'deviceMinutes' => [ 'shape' => 'DeviceMinutes', ], ], ], 'TestParameters' => [ 'type' => 'map', 'key' => [ 'shape' => 'String', ], 'value' => [ 'shape' => 'String', ], ], 'TestType' => [ 'type' => 'string', 'enum' => [ 'BUILTIN_FUZZ', 'BUILTIN_EXPLORER', 'APPIUM_JAVA_JUNIT', 'APPIUM_JAVA_TESTNG', 'APPIUM_PYTHON', 'APPIUM_WEB_JAVA_JUNIT', 'APPIUM_WEB_JAVA_TESTNG', 'APPIUM_WEB_PYTHON', 'CALABASH', 'INSTRUMENTATION', 'UIAUTOMATION', 'UIAUTOMATOR', 'XCTEST', ], ], 'Tests' => [ 'type' => 'list', 'member' => [ 'shape' => 'Test', ], ], 'URL' => [ 'type' => 'string', 'max' => 2048, 'min' => 0, ], 'UniqueProblem' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'Message', ], 'problems' => [ 'shape' => 'Problems', ], ], ], 'UniqueProblems' => [ 'type' => 'list', 'member' => [ 'shape' => 'UniqueProblem', ], ], 'UniqueProblemsByExecutionResultMap' => [ 'type' => 'map', 'key' => [ 'shape' => 'ExecutionResult', ], 'value' => [ 'shape' => 'UniqueProblems', ], ], 'UpdateDevicePoolRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'name' => [ 'shape' => 'Name', ], 'description' => [ 'shape' => 'Message', ], 'rules' => [ 'shape' => 'Rules', ], ], ], 'UpdateDevicePoolResult' => [ 'type' => 'structure', 'members' => [ 'devicePool' => [ 'shape' => 'DevicePool', ], ], ], 'UpdateProjectRequest' => [ 'type' => 'structure', 'required' => [ 'arn', ], 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'name' => [ 'shape' => 'Name', ], ], ], 'UpdateProjectResult' => [ 'type' => 'structure', 'members' => [ 'project' => [ 'shape' => 'Project', ], ], ], 'Upload' => [ 'type' => 'structure', 'members' => [ 'arn' => [ 'shape' => 'AmazonResourceName', ], 'name' => [ 'shape' => 'Name', ], 'created' => [ 'shape' => 'DateTime', ], 'type' => [ 'shape' => 'UploadType', ], 'status' => [ 'shape' => 'UploadStatus', ], 'url' => [ 'shape' => 'URL', ], 'metadata' => [ 'shape' => 'Metadata', ], 'contentType' => [ 'shape' => 'ContentType', ], 'message' => [ 'shape' => 'Message', ], ], ], 'UploadStatus' => [ 'type' => 'string', 'enum' => [ 'INITIALIZED', 'PROCESSING', 'SUCCEEDED', 'FAILED', ], ], 'UploadType' => [ 'type' => 'string', 'enum' => [ 'ANDROID_APP', 'IOS_APP', 'WEB_APP', 'EXTERNAL_DATA', 'APPIUM_JAVA_JUNIT_TEST_PACKAGE', 'APPIUM_JAVA_TESTNG_TEST_PACKAGE', 'APPIUM_PYTHON_TEST_PACKAGE', 'APPIUM_WEB_JAVA_JUNIT_TEST_PACKAGE', 'APPIUM_WEB_JAVA_TESTNG_TEST_PACKAGE', 'APPIUM_WEB_PYTHON_TEST_PACKAGE', 'CALABASH_TEST_PACKAGE', 'INSTRUMENTATION_TEST_PACKAGE', 'UIAUTOMATION_TEST_PACKAGE', 'UIAUTOMATOR_TEST_PACKAGE', 'XCTEST_TEST_PACKAGE', ], ], 'Uploads' => [ 'type' => 'list', 'member' => [ 'shape' => 'Upload', ], ], ],];
