#!/bin/bash

#Location of input file
inFile=$1

#ID video file
prefix=$2

#Directory to save multirate.m3u8  and html files
dirOut="/opt/lampp/htdocs/projecte/videos/low/"

#urlPrefix wich will be write on index file
urlPrefix="http://147.83.74.180/videos/low/"

temp_dir=$prefix;

#Directory to save all the segmented videos files in each quality
dirOutVideos=$dirOut/$prefix;

#function to transcode and segment the video file
function transcode_segment () {
#name of output file
#filename=$prefix\_$BR;
filename=$prefix;

tempfile=$prefix\_pre.ts;

#transcode
ffmpeg -i $inFile -f mpegts -acodec libmp3lame -ar 48000 -ab 64k -s 320x240 -vcodec libx264 -b $BR -flags +loop -cmp +chroma -partitions +parti4x4+partp8x8+partb8x8 -subq 5 -trellis 1 -refs 1 -coder 0 -me_range 16 -keyint_min 25 -sc_threshold 40 -i_qfactor 0.71 -bt 200k -maxrate $BR -bufsize $BR -rc_eq 'blurCplx^(1-qComp)' -qcomp 0.6 -qmin 10 -qmax 51 -qdiff 4 -level 30 -aspect 320:240 -g 30 -async 2 $temp_dir/$tempfile

#segment
segmenter $temp_dir/$tempfile 10 $temp_dir/$filename $temp_dir/$filename-index.m3u8 $urlPrefix;

#Permiss

#remove tempfile
rm $temp_dir/$tempfile

#move index file to output directory
mv $temp_dir/$filename-index.m3u8 $dirOut
chmod 777 $temp_dir/$filename-index.m3u8 

#move all the files to output directory
mv $temp_dir/* $dirOutVideos

#Update Index MultiRate File with locations of index SingleRate file
#update_indexMR $filename $BW

}

#function to create a index file with theh locations of all video qualities
function create_indexMR () {

indexMR=$dirOut/$prefix\-index.m3u8
#create index file
touch $indexMR;
chmod 777 $indexMR;

echo "#EXTM3U" >> $indexMR;

}

#function to write the locations of index singlerate files on the indexMultiRate
function update_indexMR () {

#First line with system information
echo "#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=$BW" >> $indexMR;

#url of the index file
echo $urlPrefix$prefix/$filename-index.m3u8 >> $indexMR;
}

#create the directories
mkdir $temp_dir

mkdir $dirOutVideos;
chmod 777 $dirOutVideos;

#create the index multirate file
#create_indexMR;

# Encode and segment at 240k
BR=240k
BW=240000
transcode_segment $BR $BW;

# Encode and segment at 440k
BR=440k
BW=440000
#transcode_segment $BR;

# Encode and segment 640k
BR=640k
BW=440000
#transcode_segment $BR;

rm -r $temp_dir