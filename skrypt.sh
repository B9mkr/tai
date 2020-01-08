#!/bin/bash

<<<<<<< HEAD
# make
# git commit -m "$1"
=======
# echo $2;
# make
git add -A; git status;
git commit -m \"$1\";
>>>>>>> ade156072dabfd3f104a6d8897577486e1292ca1
# git push
name=README;
pandoc $name.md --output=$name.pdf;
# pandoc $1.md --output=$1.pdf
