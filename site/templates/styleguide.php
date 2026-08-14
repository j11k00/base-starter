<?php
/**
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Site $site
 * @var \Kirby\Cms\Page $page
 */
?>
<?php snippet(
  'layouts/default',
  slots: true
)
?>

<!-- Main -->
<?php slot('main') ?>




<h2>Heading Level 2</h2>
<h3>Heading Level 3</h3>
<h4>Heading Level 4</h4>
<h5>Heading Level 5</h5>
<h6>Heading Level 6</h6>

<p>
  Lorem ipsum dolor sit amet, consectetur adipiscing elit.
  <mark>Highlighted text</mark>,
  <small>small text</small>,
  <del>deleted text</del>,
  <ins>inserted text</ins>,
  <code>inline code</code>.
</p>

<blockquote>
  This is a blockquote. It can contain multiple lines of text.
</blockquote>

<pre><code>
function hello() {
    console.log('Hello World');
}
            </code></pre>

<hr>

<h2>Lists</h2>

<h3>Unordered List</h3>
<ul>
  <li>Item One</li>
  <li>Item Two</li>
  <li>Item Three</li>
</ul>

<h3>Ordered List</h3>
<ol>
  <li>First Item</li>
  <li>Second Item</li>
  <li>Third Item</li>
</ol>

<h3>Description List</h3>
<dl>
  <dt>HTML</dt>
  <dd>Markup language for web pages.</dd>

  <dt>CSS</dt>
  <dd>Styles web pages.</dd>
</dl>
<h2>Media</h2>

<img
  src="https://placehold.co/600x400"
  alt="Placeholder image"
  width="600"
  height="400">

<figure>
  <img
    src="https://placehold.co/400x250"
    alt="Figure image"
    width="400"
    height="250">
  <figcaption>Example figure caption.</figcaption>
</figure>

<h2>Table</h2>

<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Role</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Jane Doe</td>
      <td>jane@example.com</td>
      <td>Admin</td>
    </tr>
    <tr>
      <td>John Smith</td>
      <td>john@example.com</td>
      <td>Editor</td>
    </tr>
  </tbody>
</table>

<h2>Form Elements</h2>

<form>
  <p>
    <label for="text">Text Input</label><br>
    <input type="text" id="text" placeholder="Enter text">
  </p>

  <p>
    <label for="email">Email</label><br>
    <input type="email" id="email" placeholder="name@example.com">
  </p>

  <p>
    <label for="select">Select</label><br>
    <select id="select">
      <option>Option 1</option>
      <option>Option 2</option>
      <option>Option 3</option>
    </select>
  </p>

  <p>
    <label>
      <input type="checkbox">
      Checkbox
    </label>
  </p>

  <p>
    <label>
      <input type="radio" name="radio">
      Radio Option 1
    </label>

    <label>
      <input type="radio" name="radio">
      Radio Option 2
    </label>
  </p>

  <p>
    <label for="textarea">Textarea</label><br>
    <textarea id="textarea" rows="4"></textarea>
  </p>

  <button type="submit">Submit</button>
  <button type="button">Secondary Button</button>
</form>

<?php endSlot() ?>