#!/bin/bash

make
git commit -m "$1"
git push
# pandoc $1.md --output=$1.pdf
