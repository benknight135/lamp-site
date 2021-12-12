# Release strategy
This repository uses [GitLab Flow](https://docs.gitlab.com/ee/topics/gitlab_flow.html) strategy.

## Deployment
App is deployed to Azsure automically on new releases.

## Branches
This repository has three permanent branches: 'main', 'prod', and 'docs'.
### Main
This branch has the code that will be released on successful build (likely stable).
- No code will be directly written to this branch.
- A release is triggered when code is merged to this branch.
- Versioning is automatically generated when merging, this is created by detecting the branch prefix:
    - 'major/' prefix for major release (e.g. N.x.x)
    - 'minor/' prefix for minor release (e.g. x.N.x)
    - no prefix for patch release (e.g. x.x.N)
- On successful release, this branch is merged to 'prod'.

### Prod
This is the latest production code (stable).
- No code will be directly written to this branch.
- Merge 'main' branch is merged into this branch on successful release
- Only 'main' branch can merge into this branch.

### Docs
This is static website for documentation of the latest production code (stable).
- No code will be directly written to this branch.
- GitHub workflow will commit to this branch on successful deployment. 
- Only deployment GitHub workflow can commit to this branch.
