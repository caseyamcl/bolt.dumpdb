Bolt Dump DB
============

This is a [Bolt CMS Extension](http://bolt.cm) extension that adds command for
dumping and loading the database to make scripting backups and restores very easy.

## Install

This extension is available on the [Bolt Extensions Website](http://extensions.bolt.cm).
You can install it via the *View/Install Extension* page of your Bolt CMS installation.

## Usage

After installation, you will have the following additional commands available when you
run `app/nut`:

    app/nut database:dump
    app/nut database:load

### Dumping the Database

Use the `app/nut database:dump` command to dump the database.  You can optionally 
specify an output file if you wish to dump the database to a file.  Otherwise, the
command dumps the database to *STDOUT*.

    # Dump the database to ~/backup.sql
    app/nut database:dump ~/backup.sql
    
    # Dump the database to STDOUT - Output can be piped anywhere...
    app/nut database:dump
    
    #...like, for example pipe it to SSH
    app/nut database:dump | ssh user@server 'cat - > backup.sql'

### Loading the Database

Use the `app/nut database:load` command to load the database.  **WARNING** this will
overwrite any existing tables you have in the database, so use this only for restores
or for clobbering your existing database.

You can optionally specify an input file if you wish, or you can load the database from
*STDIN*.

    # Load the database from ~/backup.sql
    app/nut database:load ~/backup.sql
    
    # Load the database from STDIN...
    cat ~/backup.sql | app/nut database:load
    
    #...like directly from another database
    mysqldump -u root my_bolt_database | app/nut database:load
        
## Contributing

Contributions are **welcome**!  Please submit a pull request or open an issue via
the Github repository page.

## License

The MIT License (MIT).  See the [License File](LICENSE) for more information.
