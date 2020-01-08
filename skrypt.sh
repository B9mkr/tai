#!/bin/bash

# make
# git commit -m "$1"
# git push
name=README;
pandoc $name.md --output=$name.pdf;
# pandoc $1.md --output=$1.pdf
