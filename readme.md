# Stylight Task

## Tools

- Docker
- [Caddy](https://caddyserver.com/)
- Git
- PHP7

## Approach

- Main git repository (origin) ubuntu@18.217.219.123:sites/app
- Development in a locally cloned repository.
- Deployment via post-receive git hook, also documented in repository.
- Hook checks for master branch commit and then builds a new docker image.
- The old container is stopped and removed and a new container launched.
- Docker image relies on alpine-linux and caddy as webserver.

This is an absolutely bare bones solution that involves only basic tools.

## Shortcomings

- Post-receive deploy script does not do error checking.
- No proper cleanup for the old images.
- No centralized logging.
- Solution does not scale well.
- Only docker binary as management tool.
- Deployment not zero downtime.
- App: no error checking, no input validation.

## Production Ready !

- Source code is hosted on the cloud (AWS code commit, github, bitbucket etc...).
- Using git branching model (master, development, qa, feature, hotfix, etc ... ).
- Using gitflow for releases and hotfixes.
- Using CI/CD tools like (Jenkins + Jenkins config file in the project root, AWS Code pipeline provided with Cloud Formation template file).
- Using Docker hub or AWS Container Registry (ECR) to host the application docker image.
- Include build, test, deployment and notification stages to the pipeline with automatic trigger based on the branch name.
- Deploy the application to AWS ECS in order to have scalable containerized application, high performance and easy to run.
- Using a dynamic Cloud Formation template to provide the infrastructure for staging and production environment (VPC, Application load balancer, ECS cluster and AWS, service, task definition and Cloud watch Alarms).
