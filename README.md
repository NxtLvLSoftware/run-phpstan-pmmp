# Action nxtlvlsoftware/run-phpstan-pmmp

GitHub action for running [PHPStan](https://github.com/phpstan/phpstan) analysis against [PocketMine-MP](https://github/pmmp/PocketMine-MP)
plugins and libraries in actions workflows. [See setup-pmmp-phpstan-env](https://github.com/NxtLvLSoftware/setup-pmmp-phpstan-env) for descriptions on provided phpstan.neon configurations.

| Action Input    | Required | Default                                  | Description                                                                                                                                                                                              |
|-----------------|----------|------------------------------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| php-version     | false    | 8.0.18                                   | Specifies the version of php to use. We try to keep the default up-to-date with PocketMine. Pull Requests welcome.                                                                                       |
| phpstan-version | false    | 1.8.2                                    | Specifies the version of phpstan to use. We try to keep the default up-to-date with PocketMine. Pull Requests welcome.                                                                                   |
| pmmp-version    | false    | latest                                   | Specifies the version of pmmp to use. Will use the latest available release by default. You should keep this locked to the API version in your plugin.yml as any non-stable release could be downloaded. |
| pmmp-source-dir | false    | ./pocketmine                             | Specifies the directory to install PocketMine sources and default phpstan.neon configs to.                                                                                                               |
| memory-limit    | false    | 1G                                       | Specifies the memory limit in the same format php.ini accepts.                                                                                                                                           |
| analyse         | false    | undefined                                | A space seperated list of paths to analyse. Providing paths here will override any paths specified in phpstan.neon files. (https://phpstan.org/config-reference#analysed-files)                          |
| level           | false    | 9                                        | Specifies the rule level to run (1-9). https://phpstan.org/user-guide/rule-levels                                                                                                                        |
| config          | false    | ./pocketmine/phpstan/phpstan.neon.dist   | Path to a phpstan.neon configuration file.                                                                                                                                                               |
| no-progress     | false    | true                                     | Turns off the progress bar.                                                                                                                                                                              |
| debug           | false    |                                          | Instead of the progress bar, it outputs lines with each analysed file before its analysis.                                                                                                               |
| quiet           | false    |                                          | Silences all the output. Useful if you’re interested only in the exit code.                                                                                                                              |
| autoload-file   | false    | ./pocketmine/phpstan/vendor/autoload.php | If your application uses a custom autoloader, you should set it up and register in a PHP file that is passed to this CLI option. Relative paths are resolved based on the current working directory.     |
| error-format    | false    | github                                   | Specifies a custom error formatter. https://phpstan.org/user-guide/output-format                                                                                                                         |
| ansi            | false    |                                          | Overrides the auto-detection of whether colors should be used in the output and how nice the progress bar should be.                                                                                     |
| xdebug          | false    |                                          | PHPStan turns off XDebug if it’s enabled to achieve better performance.                                                                                                                                  |

## How to use

Simple analysis of PocketMine plugins and libraries on GitHub Actions:

```yml
name: My PMMP Plugin Workflow
on: [ push ]
jobs:
  test-code:
    name: Run Plugin Tests
    runs-on: ubuntu-latest
    steps:
      - name: Checkout source code
        uses: actions/checkout@v2
      - name: Run PHPStan
        uses: nxtlvlsoftware/run-phpstan-pmmp@v1
```

This example will run the analysis with the default settings against any code in the `src` directory. We aim to keep the
default phpstan version in-sync with whatever PocketMine is currently using, pull requests are welcome to maintain this.

Or to lock the versions of any required tools/executables to known versions:

```yml
name: My PMMP Plugin Workflow
on: [ push ]
jobs:
  test-code:
    name: Run Plugin Tests
    runs-on: ubuntu-latest
    steps:
      - name: Checkout source code
        uses: actions/checkout@v2
      - uses: nxtlvlsoftware/run-phpstan-pmmp@v1
        with:
          analyse: src
          config: tests/phpstan/action.phpstan.neon
          level: 9
          php-version: 8.0.18
          phpstan-version: 1.8.2
          pmmp-version: 4.6.1
```
