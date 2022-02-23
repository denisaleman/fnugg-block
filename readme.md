# Ski resort Gutenberg block

## Instructions
See [instructions.md](instructions.md)

## Description
The plugin provides the user with a Gutenberg block that displays information about one of the ski resorts in Norway.

The information includes data on the state of weather, snow, windiness. The block also displays an image of the location of the resort and its name.

The data for filling the block is loaded from the site api.fnugg.no using the appropriate endpoints.

### Demo
Live:  [http://13.36.33.182/sample-page/](http://13.36.33.182/sample-page/)  
Admin: [http://13.36.33.182/wp-admin/post.php?post=2&action=edit](http://13.36.33.182/wp-admin/post.php?post=2&action=edit)

###### Credentials
login: dekode  
password: dekode

### Dependencies and Requirements
PHP 7.1 and Wordpress 5.8

### Install
The plugin uses composer in order to autoload classes only, within the plugin folder:
```bash
# composer
composer dumpautoload -o
```

#### Development
For development you need to install PHP dev dependencies, they are mostly coding style configuration files:
```bash
# composer
composer install --dev
```

The Gutenberg block itself is assembled with webpack provided all together with wordpress packages, to install them run:
```bash
# in plugin folder
cd assets/blocks/fnugg-whether/
npm install
```

In order to continue developing the block, use scripts defined in `package.json`.

## File structure
Plugin uses folder structure of [wp-strap](https://github.com/wp-strap/wordpress-plugin-boilerplate) boilerplate.
Only meaningfull parts are described bellow, others are parts of the boilerplate.

```bash
│ ## First level files
├──plugin.php                    # Main entry file for the plugin
├──composer.json                 # Composer dependencies & scripts
├──phpcs.xml                     # PHPCodeSniffer configuration
│
│ ## Folders
├──assets                        # Holds all Gutenberg block within corresponding folders
│   └── fnugg-whether            # The Gutenberg block itself
│       ├── build                # Bundles
│       ├── src                  # Source files
│       └── block.json           # Block metadata JSON file
│
└──src                           # Holds all the plugin php classes
    ├── Bootstrap.php            # Bootstraps the plugin and auto-instantiate classes
    │
    │
    ├── Fnugg                           # Namespace of the Fnugg API Integration
    │   ├── Api.php                     # Hooks/functionality shared between the back-end and frontend
    │   ├── CachingProxy.php            # Implementation of caching
    │   ├── HttpClient.php              # Client and its interface
    │   └── HttpClientInterface.php     # and its interface
    │
    └── FnuggWhetherPlugin                       # Namespace of Plugin
        ├── App                                  # Application Classes
        │     ├── General                         # General Classes
        │     │   └── Blocks.php                  # Gutenberg blocks register
        │     └── Rest                            # Rest API Controllers
        │         ├── Search.php                  # Search Resort Controller
        │         └── SuggestAutocomplete.php     # Autocomplete Controller
        │
        └── Config               # Plugin configuration
            └── Classes.php      # Defines the folders and order of classes to init

```
