data "aws_vpc" "default" {
  default = true
}

data "aws_subnet_ids" "private" {
  vpc_id = data.aws_vpc.default.id

  tags = {
    Name = "private*"
  }
}

data "aws_subnet_ids" "public" {
  vpc_id = data.aws_vpc.default.id

  tags = {
    Name = "public*"
  }
}

module "whitelist" {
  source = "git@github.com:ministryofjustice/terraform-aws-moj-ip-whitelist.git"
}

data "aws_s3_bucket" "access_log" {
  bucket = "online-lpa-${local.account_name}-lb-access-logs"
}

data "aws_s3_bucket" "lpa_pdf_cache" {
  bucket = lower("online-lpa-pdf-cache-${local.account_name}")
}

data "aws_kms_key" "lpa_pdf_cache" {
  key_id = "alias/lpa_pdf_cache-${local.account_name}"
}

data "aws_acm_certificate" "certificate_front" {
  domain = "${local.dev_wildcard}front.lpa.opg.service.justice.gov.uk"
}

data "aws_acm_certificate" "certificate_admin" {
  domain = "${local.dev_wildcard}admin.lpa.opg.service.justice.gov.uk"
}

data "aws_acm_certificate" "public_facing_certificate" {
  domain = "${local.dev_wildcard}lastingpowerofattorney.service.gov.uk"
}

data "aws_iam_role" "ecs_autoscaling_service_role" {
  name = "AWSServiceRoleForApplicationAutoScaling_ECSService"
}
