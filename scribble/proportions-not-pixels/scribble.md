<!-- scribble-title: Proportions, Not Pixels -->
<!-- scribble-lede: An example of a scribble with a demo -->
<!-- scribble-tags: css responsive design -->
<!-- scribble-image: media/css.png -->
<!-- scribble-created: 20110801 -->
<!-- scribble-modified: 20110801 -->
<!-- scribble-publish: 1 -->

Let's start off by setting our base type size to the browser’s default, which in most cases is 16 pixels. We can then use ems to size text up or down from that relative baseline. The formula to do so is **target-size / context-size = em's**.

Assuming that our base font-size of 100% on the body element equates to 16px and we would like to have a target size reflecting 24px in proportion, we can plug our desired values directly into our formula: **24px / 16px = 1.5em**
<!-- scribble-snippet: snippets/styles.css -->
<!-- scribble-snippet: snippets/markup.html -->

[See it in action](demo/)