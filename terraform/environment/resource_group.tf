resource "aws_resourcegroups_group" "environment" {
  name = local.environment
  tags = local.default_tags
  resource_query {
    query = local.environment_resource_group_query
  }
}

locals {
  environment_resource_group_query = jsonencode({
    ResourceTypeFilters = [
      "AWS::AllSupported"
    ],
    TagFilters = [
      {
        Key    = "environment-name",
        Values = [local.environment]
      }
    ]
  })
}
