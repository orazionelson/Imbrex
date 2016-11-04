<h1>Imbrex 0.0.1 alfa</h1>
<blockquote>&laquoBent or curved tile like a half-cylinder used for gutters or for covering the junction of adjacent concave or flat tiles with upstands.&raquo</blockquote> 

Imbrex is a tool to manage collections of linked textes and images. It came from [TILE](http://mith.umd.edu/tile/), <b>Text-Image Linking Environment</b>, but Imbrex has a new design, web oriented and centered on usability, user experience.

<h2>Install</h2>
Imbrex is built as a module of [No-CMS](http://getnocms.com/), so you have to install it before using Imbrex.

Don't you know what is [No-CMS](http://getnocms.com/)?

Look at [No-CMS](http://getnocms.com/) home page and take few minutes to learn about this great, useful, bare CMF built on top of [Codeigniter](http://www.codeigniter.com/), [Grocery-CRUD](http://www.grocerycrud.com/) and [Bootstrap](http://getbootstrap.com/).

Then:

1) Install No-CMS and login as Admin

2) Copy the imbrex folder in _yournocms/modules_ directory

3) Go to *CMS Management > Modules*, and click the button "Activate" below the Imbrex box.

After the Installation you'll find two links "View series" and "View Editions" on the top-menu, and the links for the <b>Imbrex admin interface</b> in the drop-down menu that comes from the icon on the left of the top bar. 

<h3>Install imbrex_data</h3>
Imbrex installation comes with an empty db, if you want to try imbrex with some data install the module *imbrex_data*. 

It contains: 

- two sample Series,

- three Editions

- some Tiled text/images

Once installed ... play with Imbrex.

<h2>Use</h2>
After you understood <b>Imbrex</b> by the sandbox provided with *imbrex_data* module you can start to add your Series and Editions. 

<b>Be carefull: UNINSTALL *imbrex_data* before starting your job, if you don't uninstall the samples later you risk to loose al your imbrex db data.</b>  

Follow this workflow, choose from imbrex menu:

1) Manage Series: Here you will define a series for your editions and the labels used to mark-up the text.

2) Manage Editions: Here you'll work on editions. This part of the job is divided in two steps. 
	
* In the _Step1_ you can define metadata for the edition and its XML ID.
	

* In the _Step2_ you can define other features of the object, i.e. the type, the language, the pages.
	

* Step2 will lead you to single page editing.

3) Pages editing also consists of two steps.

* In the first step you can add the page image and edit its content. Once you finished flag the page as "Closed", this will push it in the _Tiled pages_ basket.

* In the _Tiled pages_ area you can link the image and the content.    

<b>TIP: Most of the Imbrex field names are taken from [_TEI:Text Encoding Initiative_](www.tei-c.org/), before starting with a series and an edition spend some time to undestand TEI. </b>

<h2>Release Notes</h2>
Imbrex 0.0.1 is an alfa release, it means that there are still a lot of things to do, specially for interoperability, the user experience in the Tiles Editing interface and for end-user-views. 
 
The workflow for jobs assignments from Imbrex Manager to Editors is still under construction.

Moreover, there is a lot of unused code from TILE that has to be used or deleted.

There are some javascript bugs.

A lot of documentation has to be written.

If you want to help me don't exitate to write me for: bugs, feature request, offers of cooperation, etc...

alfredo.cosco@gmail.com

twitter: @orazionelson
 
<h2>License</h2>
Imbrex is released under MIT Licence.


<h2>To do</h2>
- export in TEI and OAI-PMH
- widgets for published and featured
- images are not elaborated, it would be better to resize them and create thumbs on upload

<h2>Addenda</h2>
<h3>Imbrex db schema</h3>
<h4>Series</h4>
- cmsprefix_imbrex_filedesc_seriesstmt
	* cmsprefix_imbrex_filedesc_seriesstmt_idno
	* cmsprefix_imbrex_filedesc_seriesstmt_respstmt
	* cmsprefix_imbrex_tet_labels

<h4>Edition Step 1</h4>
- cmsprefix_imbrex_filedesc
	* cmsprefix_imbrex_analytic_author
	* cmsprefix_imbrex_analytic_editor
	* cmsprefix_imbrex_biblstruct_idno
	* cmsprefix_imbrex_publicationstmt_publisher
	* cmsprefix_imbrex_titlestmt_author
	* cmsprefix_imbrex_titlestmt_editor
	* cmsprefix_imbrex_titlestmt_respstmt
	* cmsprefix_imbrex_languages

<h4>Edition Step 2</h4>
- cmsprefix_imbrex_text

<h4>Pages</h4>
- cmsprefix_imbrex_text_body_lg
	* cmsprefix_imbrex_page_labels
	* cmsprefix_imbrex_text_selections
	* cmsprefix_imbrex_text_shapes


<h4>Editor Dashboard</h4>
- cmsprefix_imbrex_mte_jobs