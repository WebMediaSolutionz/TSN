# Installing TSN2 ( The Social Network Network )

## Step 1: Install WampServer

Install WampServer if you are using windows

go to this URL and get the WampServer: [here](http://www.wampserver.com/en/)

## Step 2: Install Node, NPM and gulp

Install Node and NPM on your machine; this typically requires administrative access, 
e.g. become root or use `sudo` (or use a Windows installer).

You must be running at least Node 4.x.x and npm 3.x.x. You can verify 
what, if any, versions you have installed by running `node -v` and 
`npm -v` in a terminal window.

You can download current versions of these tools [here](https://nodejs.org/en/download/current/).

If you use a Linux-like environment, you are encouraged to use your
package manager to install these tools.

If you use OS X, you may wish to consider installing via [HomeBrew](http://brew.sh/).

The `gulp` build tool also requires root access to install a binary in `/usr/bin`, so should
be installed using `sudo` now:

`$ sudo npm install -g gulp`

Once installed, you should be able to run the `gulp` command from anywhere.

## Step 3: Check out the source code

IMPORTANT NOTE: This, and all following steps, should be run as a regular (non-root) user.
Strange problems occur with package installation when you are the root user, or from using
the `sudo` command.

In a command shell, make a clone of the git repository:

`$ git clone https://github.com/WebMediaSolutionz/TSN2.git`

Then enter the directory created. All further commands will be run inside that directory.

`$ cd TSN2`

## Step 3: Install the NPM dependencies

`$ npm install`