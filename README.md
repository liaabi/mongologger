PHPMongoTweet on OpenShift
==========================

This git repository helps you get up and running quickly w/ a PHP sample application
that uses MongoDB on OpenShift

Running on OpenShift
--------------------

Create an account at http://openshift.redhat.com/

Create a php-5.3 application

    rhc app create -a phpmongotweet -t php-5.3

Add MongoDB support to your application

    rhc cartridge add -a phpmongotweet -c mongodb-ha

Add this upstream phpmongotweet repo

    cd phpmongotweet
    git remote add upstream -m master git://github.com/openshift/phpmongotweet-example.git
    git pull -s recursive -X theirs upstream master


Then push the repo upstream

    git push

That's it, you can now checkout your application at:
    http://phpmongotweet-$yourlogin.rhcloud.com

