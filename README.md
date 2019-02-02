# upload-file

## Instructions

* Set up a **multiple** image upload system, which will only accept files **smaller than 1Mo**, and only **jpg, png or gif** files.

* File names should start with 'image' followed by a unique identifier and then the extension, eg: **image15163e5b15.png**.

* View thumbnails of previously downloaded images and the name of each file.

* In each thumbnail, add a delete button to delete the file from the server.

So as not to be burdened here with database management, for this exercise, you will have to list directly the files contained in your `upload` folder.

## Installation

Clone the repository :

```
git clone https://github.com/JuAlexandre/upload-files.git
```

Launch the PHP server in `upload-files` folder :

```
php -S localhost:8000
```