# Development strategy
This repository uses GitHub issues for task tracking. All changes to the code should be associated with a GitHub issue.  
Gitpod configuration files are provided for quick & simple cloud development.

As a developer:
1. Find an open [GitHub issues](https://github.com/i3drobotics/imath-requests/issues) or create a new issue.
2. Create a new branch from the 'main' branch with short descriptive name and the issue number e.g. issue 22 that adds tests for a function 'foo' could be called 'add-foo-tests-22'. Easiest way to do this is clicking 'gitpod' button using the [gitpod extension](https://www.gitpod.io/docs/browser-extension/) from a GitHub issue or appending the gitpod prefix to the issue link e.g. https://gitpod.io/#https://github.com/benknight135/lamp-stack-hello/issues/1.
5. Make your code changes specific to this issue. Commits should be easily revertable and contain a descriptive message. 
6. Locally test code changes.
7. Create pull request to 'main' branch with a descriptive name of the changes made. Link the issue to the pull request on GitHub.
8. Issue branch will be automatically tested, check these tests pass. (If not continue to make commits until tests pass).
9. Admin will merge to main after manual review.

As an admin:
1. Find an open [GitHub pull request](https://github.com/i3drobotics/imath-requests/pulls).
2. Check automatic tests have passed.
3. Manually review code changes.
4. Merge pull request.
5. Code will be deployed. On succesfull deployment, 'main' is merged to 'prod'.
