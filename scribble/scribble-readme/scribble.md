<!-- scribble-title: Scribble Readme -->
<!-- scribble-lede: The underlying text file storage service -->
<!-- scribble-tags: markdown textile plain-text storage -->
<!-- scribble-created: 20120507 -->
<!-- scribble-modified: 20120507 -->
<!-- scribble-publish: 1 -->
<!-- scribble-ignore-snippets: 1 -->

Text file storage service.

## Features

+ Content storage in text files (currently ships with output filters for [Markdown](http://daringfireball.net/projects/markdown/syntax), [Textile](http://textile.thresholdstate.com/), plain text and HTML)
+ Embed snippets from external files
+ Plugin-architecture for custom input and output filters
+ Meaningful listings and search
+ Normalize multiple input formats

## Basic Usage

Loading a Markdown file:

    use Sirprize\Scribble\File\ScribbleFile;
    use Sirprize\Scribble\File\Format\Markdown\InputFilter\CodeSnippetFilter;
    use Sirprize\Scribble\File\Format\Markdown\OutputFilter\HtmlConverterFilter;
    
    $scribble = new ScribbleFile();
    
    $scribble
        ->addInputFilter('snippet', new CodeSnippetFilter())
        ->addOutputFilter('html', new HtmlConverterFilter())
        ->load('/path/to/scribble.md')
    ;

Loading a Textile file:

    use Sirprize\Scribble\File\ScribbleFile;
    use Sirprize\Scribble\File\Format\Textile\InputFilter\CodeSnippetFilter;
    use Sirprize\Scribble\File\Format\Textile\OutputFilter\HtmlConverterFilter;

    $scribble = new ScribbleFile();

    $scribble
        ->addInputFilter('snippet', new CodeSnippetFilter())
        ->addOutputFilter('html', new HtmlConverterFilter())
        ->load('/path/to/scribble.textile')
    ;

Different formats are loaded merely by adding filters to the scribble object. Usage of the content is independent of the originating format:

    <article>
        <time datetime="<?php echo $scribble->getCreated()->format('Y-m-d'); ?>">
            <?php echo $scribble->getCreated()->format('F j, Y'); ?>
        </time>
        
        <h1><?php echo $scribble->getTitle(); ?></h1>
        
        <?php if($scribble->getTags()->count()): ?>
            <ul class="tags">
                <?php foreach($scribble->getTags() as $tag): ?>
                    <li><?php echo $tag; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        
        <p class="content">
            <?php echo $scribble->getContent(); ?>
        </p>
    </article>

By default, Scribble uses HTML comments for keyword delimiting, but this is configurable:

    $config = array(
        'leftKeywordDelimiter' => '{{',
        'rightKeywordDelimiter' => '}}'
    );
    
    $scribble = new ScribbleFile($config);

## Scribblin' (Writing Posts)

Here's a typical scribble file containing a blog bost. Information such as title, tags and creation date is added into keywords. Beside title and creation date, keywords are optional. This information is used by Scribble to provide functionality such as post listings and is available through getter methods on `Sirprize\Scribble\File\ScribbleFile` objects.

        <!-- scribble-title: Proportions, Not Pixels -->
        <!-- scribble-lede: Embrace the flexibility inherent to the web in your design  -->
        <!-- scribble-tags: design css responsive -->
        <!-- scribble-image: media/css.png -->
        <!-- scribble-created: 20110801 -->

        Let's start off by setting our base type size to the browser’s default, which in most cases is 16 pixels. We can then use ems to size text up or down from that relative baseline. The formula to do so is **target-size / context-size = em's**.

        Assuming that our base font-size of 100% on the body element equates to 16px and we would like to have a target size reflecting 24px in proportion, we can plug our desired values directly into our formula: **24px / 16px = 1.5em**
        <!-- scribble-snippet: snippets/styles.css -->
        <!-- scribble-snippet: snippets/markup.html -->
        [See it in action](demo)

This will translate into:

        <p>Let's start off by setting our base type size to the browser’s default, which in most cases is 16 pixels. We can then use ems to size text up or down from that relative baseline. The formula to do so is <strong>target-size / context-size = em's</strong>.</p>

        <p>Assuming that our base font-size of 100% on the body element equates to 16px and we would like to have a target size reflecting 24px in proportion, we can plug our desired values directly into our formula: <strong>24px / 16px = 1.5em</strong></p>

        <pre>
            <code>
                body { font-size: 100%; }
                h1 { font-size: 1.5em; /* 24px / 16px */ }
                p { font-size: 1em; /* 16px / 16px */ }
            </code>
        </pre>

        <pre>
            <code>
                <h1>This Title is now 1.5em's (24px In The Context Of 16px)</h1>
                <p>Some text at 1em (16px in the context of 16px)</p>
            </code>
        </pre>

        <a href="demo">See it in action</a>

Note how code snippets got pulled into the document.

### Keywords

Except `scribble-snippet`, Scribble looks for the first occurence of any type of tag. Comments are left untouched. 

#### Title

First occurence available in `Scribble::getTitle()`, required

    <!-- scribble-title: Title For This Post -->

#### Creation Date

First occurence available in `Scribble::getCreated()`, required

    <!-- scribble-created: 20111006 -->

#### Modification Date

First occurence available in `Scribble::getModified()`, optional (defaults to creation date)

    <!-- scribble-modified: 20111006 -->

#### Image File

First occurence available in `Scribble::getImage()`, optional

    <!-- scribble-image /path/to/some/image-file -->

#### Tags

First occurence available in `Scribble::getTags()`, optional

    <!-- scribble-tags: tag1 tag2 tag3 -->

#### Lead Paragraph

First occurence available in `Scribble::getLede()`, optional

    <!-- scribble-lede: Lead paragraph for this post -->

#### Publish

Whether this scribble should be published `Scribble::isPublished()`, optional

    <!-- scribble-publish: (0|1) -->

#### Embed Snippet From File

Place contents of this file into content

    <!-- scribble-snippet: /path/to/some/code-file -->

#### Language Hinting

Language hinting for syntax highlighters. This will set {language} in the class attributes of consecutive `<pre><code>` tags.

    <!-- scribble-language-hint: css -->
    body { font-size: 100%; }
    h1 { font-size: 1.5em; }
    p { font-size: 1em; }

This translates to:

    <pre class="css">
        <code class="css">
            body { font-size: 100%; }
            h1 { font-size: 1.5em; }
            p { font-size: 1em; }
        </code>
    </pre>

### Special Keywords

These are probably only useful when scribblin' about [Scribble](https://github.com/sirprize/scribble). For example, they would be set to `1` for this guide

#### Ignore Snippets

    <!-- scribble-ignore-snippets: (0|1) -->

Ignore `scribble-snippet` tags

#### Leave Keywords In Content

    <!-- scribble-keep-keywords: (0|1) -->

Don't clean up and leave keywords in content

## Handling Lists Of Files

Two use cases are currently covered:

### Scribbles In Subdirs

`Sirprize\Scribble\ScribbleDirWithSubdirs` takes a base directory where each post lives in a sub-directory with content stored in a single text file:

    + scribble-dir
        + brighter-by-whomadewho
            + scribble.txt
        + getting-started-with-scribble
            + scribble.md
        + proportions-not-pixels
            + scribble.md
        + yin-yang-food-chart
            + scribble.html

Configuration

    use Sirprize\Scribble\ScribbleDirWithSubdirs;
    
    $config = array(
        'dir' => __DIR__.'/scribble-dir',
        'path' => '/scribble-dir',
        'files' => array(
            'scribble.md' => $markdownFiltersConfig,
            'scribble.textile' => $textileFiltersConfig,
            'scribble.txt' => $plaintextFiltersConfig,
            'scribble.html' => $htmlFiltersConfig
        )
    );
    
    $directory = new ScribbleDirWithSubdirs($config);

Assuming that we'd like to store Markdown content in files named `scribble.md`, we will map a series of input and output filters to this filename. See configurations below

### Scribbles in Base Directory

`Sirprize\Scribble\ScribbleDirWithFiles` takes a base directory where each post lives in a single text file:

    + scribble-dir
        + brighter-by-whomadewho.txt
        + getting-started-with-scribble.md
        + proportions-not-pixels.md
        + yin-yang-food-chart.html

Configuration

    use Sirprize\Scribble\ScribbleDirWithFiles;
    
    $config = array(
        'dir' => __DIR__.'/scribble-dir',
        'path' => '/scribble-dir',
        'suffices' => array(
            'md' => $markdownFiltersConfig,
            'textile' => $textileFiltersConfig,
            'txt' => $plaintextFiltersConfig,
            'html' => $htmlFiltersConfig
        )
    );
    
    $directory = new ScribbleDirWithFiles($config);

### Filter Config For Markdown

    $markdownFiltersConfig = array(
        'inputFilters' => array(
            'Sirprize\Scribble\File\Format\Markdown\InputFilter\CodeSnippetFilter' => array()
        ),
        'outputFilters' => array(
            'Sirprize\Scribble\File\Format\Markdown\OutputFilter\HtmlConverterFilter' => array(),
            'Sirprize\Scribble\File\Format\Markdown\OutputFilter\CodeblockLanguageHintFilter' => array()
        )
    );

In this example, `CodeSnippetFilter` pulls in external files and embeds the content into code blocks. `HtmlConverterFilter` converts the resulting Markdown to HTML.

### Filter Config For Textile

    $textileFiltersConfig = array(
        'inputFilters' => array(
            'Sirprize\Scribble\File\Format\Textile\InputFilter\CodeSnippetFilter' => array()
        ),
        'outputFilters' => array(
            'Sirprize\Scribble\File\Format\Textile\OutputFilter\HtmlConverterFilter' => array(),
            'Sirprize\Scribble\File\Format\Textile\OutputFilter\CodeblockBlankLineFixerFilter' => array(),
            'Sirprize\Scribble\File\Format\Textile\OutputFilter\CodeblockLanguageHintFilter' => array()
        )
    );

### Filter Config For Plain Text

    $plaintextFiltersConfig = array(
        'inputFilters' => array(
            'Sirprize\Scribble\File\InputFilter\SnippetFilter' => array()
        ),
        'outputFilters' => array(
            'Sirprize\Scribble\File\Format\Plaintext\OutputFilter\HtmlConverterFilter' => array()
        )
    );

### Filter Config For HTML

    $htmlFiltersConfig = array(
        'inputFilters' => array(
            'Sirprize\Scribble\File\InputFilter\SnippetFilter' => array()
        )
    );

### Usage

Start service and load content

    use Sirprize\Scribble\ScribbleDirWithSubdirs;
    use Sirprize\Scribble\Filter\Criteria;
    use Sirprize\Scribble\Filter\Filter;

    // load scribbles
    $directory = new ScribbleDirWithSubdirs($config);
    $allScribbles = $directory->load()->getScribbles()->sortByCreationDate(true);

    // search criteria
    $criteria = new Criteria();
    $criteria->setTags(array('music', 'electronic'));
    $criteria->setMode(Criteria::MODE_PUBLISHED);

    // filter
    $filter = new Filter();
    $filter->apply($allScribbles, $criteria);
    $scribbles = $filter->getScribbles();

    // tags
    $tags = $allScribbles->getTags()->sort(true);
    $tagCounts = $allScribbles->getTagCounts();

Iterate over the list of scribbles

    <?php if($scribbles->count()): ?>
        <ul>
            <?php foreach($scribbles as $scribble): ?>
                <li>
                    <a href="<? echo $scribble->getPath(); ?>">
                        <?php echo $scribble->getTitle(); ?>
                    </a>

                    (<?php echo $scribble->getCreated()->format('F d, Y'); ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

List all tags from all scribbles

    <ul>
        <?php foreach($tags as $key => $tag): ?>
            <li>
                <?php echo $tag; ?>
                (<?php echo $tagCounts->get($key); ?>)
            </li>
        <?php endforeach; ?>
    </ul>

## Requirements

+ PHP 5.3+

## Dependencies

These fine libraries ship with Scribble:

+ [Doctrine2 Common](https://github.com/doctrine/common)
+ [Php Markdown](https://github.com/michelf/php-markdown/)
+ [Textile](https://github.com/netcarver/textile)

## License

See LICENSE.