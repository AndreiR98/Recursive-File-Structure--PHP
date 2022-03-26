# Recursive File Structure  PHP
 Recursive File Structure in PHP


# Input:
C:/Documents/Images/Image1.jpg
C:/Documents/Images/Image2.jpg
C:/Documents/Images/Image3.jpg
C:/Documents/Works/Letter.doc
C:/Documents/Works/Accountant/Accounting.xls
C:/Documents/Works/Accountant/AnnularReport.xls
C:/Program Files/Skype/Skype.exe
C:/Program Files/Skype/Readme.txt
C:/Program Files/Mysql/Mysql.exe
C:/Program Files/Mysql/Mysql.com


# Output:
Array
(
    [C:] => Folder Object
        (
            [name:protected] => C:
            [id:Folder:private] => FOLDER
            [parent:protected] => 
            [child:protected] => Array
                (
                    [0] => Documents
                )

            [files:protected] => Array
                (
                )

        )

    [Documents] => Folder Object
        (
            [name:protected] => Documents
            [id:Folder:private] => FOLDER
            [parent:protected] => C:
            [child:protected] => Array
                (
                    [0] => Images
                )

            [files:protected] => Array
                (
                )

        )

    [Images] => Folder Object
        (
            [name:protected] => Images
            [id:Folder:private] => FOLDER
            [parent:protected] => Documents
            [child:protected] => Array
                (
                )

            [files:protected] => Array
                (
                    [0] => Image1.jpg

                )

        )

    [Image1.jpg
] => File Object
        (
            [id:File:private] => FILE
            [name:protected] => Image1
            [extension:protected] => jpg

        )

    [Image2.jpg
] => File Object
        (
            [id:File:private] => FILE
            [name:protected] => Image2
            [extension:protected] => jpg

        )

    [Image3.jpg
] => File Object
        (
            [id:File:private] => FILE
            [name:protected] => Image3
            [extension:protected] => jpg

        )

    [Works] => Folder Object
        (
            [name:protected] => Works
            [id:Folder:private] => FOLDER
            [parent:protected] => 
            [child:protected] => Array
                (
                )

            [files:protected] => Array
                (
                )

        )

    [Letter.doc
] => File Object
        (
            [id:File:private] => FILE
            [name:protected] => Letter
            [extension:protected] => doc

        )

    [Accountant] => Folder Object
        (
            [name:protected] => Accountant
            [id:Folder:private] => FOLDER
            [parent:protected] => 
            [child:protected] => Array
                (
                )

            [files:protected] => Array
                (
                )

        )

    [Accounting.xls
] => File Object
        (
            [id:File:private] => FILE
            [name:protected] => Accounting
            [extension:protected] => xls

        )

    [AnnularReport.xls
] => File Object
        (
            [id:File:private] => FILE
            [name:protected] => AnnularReport
            [extension:protected] => xls

        )

    [Program Files] => Folder Object
        (
            [name:protected] => Program Files
            [id:Folder:private] => FOLDER
            [parent:protected] => 
            [child:protected] => Array
                (
                )

            [files:protected] => Array
                (
                )

        )

    [Skype] => Folder Object
        (
            [name:protected] => Skype
            [id:Folder:private] => FOLDER
            [parent:protected] => 
            [child:protected] => Array
                (
                )

            [files:protected] => Array
                (
                )

        )

    [Skype.exe
] => File Object
        (
            [id:File:private] => FILE
            [name:protected] => Skype
            [extension:protected] => exe

        )

    [Readme.txt
] => File Object
        (
            [id:File:private] => FILE
            [name:protected] => Readme
            [extension:protected] => txt

        )

    [Mysql] => Folder Object
        (
            [name:protected] => Mysql
            [id:Folder:private] => FOLDER
            [parent:protected] => 
            [child:protected] => Array
                (
                )

            [files:protected] => Array
                (
                )

        )

    [Mysql.exe
] => File Object
        (
            [id:File:private] => FILE
            [name:protected] => Mysql
            [extension:protected] => exe

        )

    [Mysql.com
] => File Object
        (
            [id:File:private] => FILE
            [name:protected] => Mysql
            [extension:protected] => com

        )

)
