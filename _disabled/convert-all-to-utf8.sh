#!/bin/bash
find . -name \*.html -type f | \
    (while read file; do
    	#file "$file";
    	#encoding=$(file -bi "$file");
    	#echo "$encoding\t$file";
        #iconv -f $encoding -t UTF-8 "$file" > "../encoded/$file";
        enconv "$file" --convert-to=UTF-8 -L none;
    done);
