<!-- scribble-title: Markdown Example Post -->
<!-- scribble-lede: A summary of Markdown elements for CSS testing -->
<!-- scribble-tags: markdown css -->
<!-- scribble-created: 20120505 -->
<!-- scribble-modified: 20120505 -->
<!-- scribble-publish: 1 -->

Here's most of the elements from the [Daring Fireball](http://daringfireball.net/projects/markdown/syntax) syntax doc:

This is an H1 (Setext style)
=============

This is an H2 (Setext style)
-------------

# This is an H1

## This is an H2

### This is an H3

#### This is an H4

##### This is an H5

###### This is an H6


## Blockquote

> This is a blockquote with two paragraphs. Lorem ipsum dolor sit amet,
> consectetuer adipiscing elit. Aliquam hendrerit mi posuere lectus.
> Vestibulum enim wisi, viverra nec, fringilla in, laoreet vitae, risus.
> 
> Donec sit amet nisl. Aliquam semper ipsum sit amet velit. Suspendisse
> id sem consectetuer libero luctus adipiscing.

## Lazy Blockquote

> This is a blockquote with two paragraphs. Lorem ipsum dolor sit amet,
consectetuer adipiscing elit. Aliquam hendrerit mi posuere lectus.
Vestibulum enim wisi, viverra nec, fringilla in, laoreet vitae, risus.

> Donec sit amet nisl. Aliquam semper ipsum sit amet velit. Suspendisse
id sem consectetuer libero luctus adipiscing.

## Nested Blockquote

> This is the first level of quoting.
>
> > This is nested blockquote.
>
> Back to the first level.

## Blockquote With Other Elements

> ## This is a header.
> 
> 1.   This is the first list item.
> 2.   This is the second list item.
> 
> Here's some example code:
> 
>     return shell_exec("echo $input | $markdown_script");

## Unordered List With *

*   Red
*   Green
*   Blue

## Unordered List With +

+   Red
+   Green
+   Blue

## Unordered List With -

-   Red
-   Green
-   Blue

## Ordered List

9.  Bird
1.  McHale
3.  Parish

## List With Paragraphs

*   This is a list item with two paragraphs.

    This is the second paragraph in the list item. You're
only required to indent the first line. Lorem ipsum dolor
sit amet, consectetuer adipiscing elit.

*   Another item in the same list.

## List With Blockquote

*   A list item with a blockquote:

    > This is a blockquote
    > inside a list item.

## List With Code block

*   A list item with a code block:

        <code goes here>

## Code block

    <div class="footer">
        &copy; 2004 Foo Corporation
    </div>

## Horizontal Rules

* * *

***

*****

- - -

---------------------------------------

## Inline Links

This is [an example](http://example.com/ "Title") inline link.

[This link](http://example.net/) has no title attribute.

## Automatic Inline Links

<http://example.com/>

<address@example.com>

## Reference Links

[id]: http://example.com/  "Optional Title Here"

This is [an example][id] reference-style link.

## Emphasis

*single asterisks*

_single underscores_

**double asterisks**

__double underscores__

## Code

Use the `printf()` function.

## Code With Backticks

``There is a literal backtick (`) here.``

## Images

![Alt text](images/scribbled.png)