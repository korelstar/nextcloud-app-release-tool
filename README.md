# Release tool for Nextcloud apps

For signing and publishing a Nextcloud app, peronal certificates resp. access tokens are required.
This repository contains a workflow for automating the process of publishing an app while keeping this data private.

## Prerequisite
Your Nextcloud app must be located in the [Nextcloud organization](https://github.com/nextcloud) (e.g. https://github.com/nextcloud/notes) and the app name must be equal to the repository name.

## How to configure this tool
You have to fork this repository on GitHub and save the following repository secrets in the forked repository:
- `GH_API_USER`: your GitHub user id, required for creating a release on GitHub. This user must have the right to create a release in the app's repository.
- `GH_API_PERSONAL_TOKEN`: an API token (personal token) for your GitHub user id. The token must have the right to create a release in the app's repository.
- `NEXTCLOUD_APPSTORE_SIGNING_PRIVATE_KEY`: Private key that is associated with your app.
- `NEXTCLOUD_APPSTORE_API_TOKEN`: API token for the Nextcloud Appstore. Required for publishing the release in the appstore.

## How to use this tool
This tool contains two GitHub workflows which have to be started one after the other. First, you have to start "*Build and release on GitHub*", then publish the created release on GitHub and finally start "*Publish to Nextcloud app store*".

### Build and release on GitHub (`release.yml`)
Checks out the app, builds and signs it (`make appstore`) and creates a release (draft) on GitHub with the builded artifact. The version is automatically extracted from app's `appinfo/info.xml`. The GitHub release description contains the changelog for this version. The changelog is automatically extracted from app's `CHANGELOG.md`.

Parameters:
- `Application ID`: app id, must be equal to the repository name (e.g. `notes`).
- `Branch` (or tag or commit): points to the commit that should be builded (default is `master`).

### Publish to Nextcloud app store (`publish.yml`)
Publishes the app to the Nextcloud appstore.

Parameters:
- `Application ID`: app id, must be equal to the repository name (e.g. `notes`).
- `Version`: version that should be published to the Nextcloud appstore. For this version, a respective (published) release on GitHub must exists and must have a build artifact.
