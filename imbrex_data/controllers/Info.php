<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Installation script for imbrex
 *
 * @author No-CMS Module Generator
 */
class Info extends CMS_Module {

   protected $DATA = array(
		//Series
        'imbrex_filedesc_seriesstmt' => array(
            array('series_id' => '1','public' => '1','featured' => '0','idno' => '','title' => 'The Algernon Charles Swinburne Project','description' => '<p>A Digital Collection Devoted to the Life and Work of Victorian Poet Algernon Charles Swinburne.</p>','respstmt' => '','logo' => 'a181d-victorian1-300px.png','cover' => 'e5a40-swinbourne_cover.jpg','labels' => NULL),
			array('series_id' => '2','public' => '1','featured' => '0','idno' => NULL,'title' => 'Mixed Contents','description' => '<p>A gallery of Mixed Contents just to show different ways to use IMBREX</p>','respstmt' => NULL,'logo' => 'dc509-ancient-building-icon-300px.png','cover' => NULL,'labels' => NULL)
		),
				
        'imbrex_filedesc_seriesstmt_respstmt' => array(
			array('resp_id' => '1','series_id' => '1','resp' => 'Edited by','type' => 'pers','name' => 'John A. Walsh','key' => 'jawalsh'),
			array('resp_id' => '2','series_id' => '2','resp' => 'Editor','type' => 'pers','name' => 'Alfredo Cosco','key' => 'ac')
        ),
        
        'imbrex_filedesc_seriesstmt_idno' => array(
            array('idno_id' => '1','series_id' => '1','type' => 'DOI','idno' => ' doi:99.99.1111/acs1001')
        ),
        		
		'imbrex_text_labels' => array(
		  array('label_id' => '1','series_id' => '1','id' => 'l_555','name' => 'head'),
		  array('label_id' => '2','series_id' => '1','id' => 'l_542','name' => 'epigraph'),
		  array('label_id' => '3','series_id' => '1','id' => 'l_234','name' => 'persName'),
		  array('label_id' => '6','series_id' => '1','id' => 'l_209','name' => 'author'),
		  array('label_id' => '10','series_id' => '1','id' => 'l_153','name' => 'question'),
		  array('label_id' => '11','series_id' => '1','id' => 'l_66','name' => 'title'),
		  array('label_id' => '12','series_id' => '2','id' => 'l_100','name' => 'philosopher'),
		  array('label_id' => '13','series_id' => '2','id' => 'l_513','name' => 'Plato'),
		  array('label_id' => '14','series_id' => '2','id' => 'l_420','name' => 'Aristotle'),
		  array('label_id' => '15','series_id' => '2','id' => 'l_498','name' => 'book'),
		  array('label_id' => '16','series_id' => '2','id' => 'l_417','name' => 'Timaeus'),
		  array('label_id' => '17','series_id' => '2','id' => 'l_363','name' => ' Nicomachean Ethics'),
		  array('label_id' => '18','series_id' => '2','id' => 'l_254','name' => 'Leonardo da Vinci'),
		  array('label_id' => '19','series_id' => '2','id' => 'l_370','name' => 'Bastiano da Sangallo'),
		  array('label_id' => '20','series_id' => '2','id' => 'l_229','name' => 'title'),
		  array('label_id' => '21','series_id' => '2','id' => 'l_160','name' => 'Mary'),
		  array('label_id' => '22','series_id' => '2','id' => 'l_396','name' => 'Christ'),
		  array('label_id' => '23','series_id' => '2','id' => 'l_38','name' => 'John the Baptist'),
		  array('label_id' => '24','series_id' => '2','id' => 'l_65','name' => 'goldfinch'),
		  array('label_id' => '25','series_id' => '2','id' => 'l_436','name' => 'protocollo'),
		  array('label_id' => '26','series_id' => '2','id' => 'l_364','name' => 'testo'),
		  array('label_id' => '27','series_id' => '2','id' => 'l_490','name' => 'escatocollo'),
		  array('label_id' => '28','series_id' => '2','id' => 'l_510','name' => 'rubrica'),
		  array('label_id' => '29','series_id' => '2','id' => 'l_272','name' => 'capolettera'),
		  array('label_id' => '30','series_id' => '2','id' => 'l_555','name' => 'illustrazione')
		  ),
		  
		  //Edition S1
		'imbrex_filedesc' => array(
			array('ed_id' => '1','xml_id' => 'acs0000001-01-i010','public' => '1','featured' => '0','seriesstmt' => '1','titlestmt_title' => 'Anactoria','titlestmt_author' => '','titlestmt_editor' => '','titlestmt_respstmt' => '','publicationstmt_publisher' => '','publicationstmt_pubplace' => 'Bloomington, IN','publicationstmt_date' => '2008','publicationstmt_authority' => 'John Doe','publicationstmt_availability' => '<p>Copyright &copy; 1997-2009 John A. Walsh.</p><p><!--Creative Commons License-->This work is licensed under an <ref 3.0="" by-nc-sa="" creativecommons.org="" http:="" licenses="" target="\\">Attribution-Noncommercial-Share Alike 3.0 Unported License</ref>.</p>','sourcedesc_biblstruct_analytic_title' => 'Anactoria','sourcedesc_biblstruct_analytic_author' => '','sourcedesc_biblstruct_analytic_editor' => '','sourcedesc_biblstruct_monogr_title' => 'The Poems of Algernon Charles Swinburne','sourcedesc_biblstruct_monogr_imprint_pubplace' => 'London','sourcedesc_biblstruct_monogr_imprint_publisher' => 'Chatto & Windus','sourcedesc_biblstruct_monogr_imprint_date' => '1904','sourcedesc_biblstruct_monogr_imprint_biblscope_vol' => '1','sourcedesc_biblstruct_monogr_imprint_biblscope_pp' => '57-66','sourcedesc_biblstruct_monogr_extent' => '6 vols','sourcedesc_biblstruct_idno' => ''),
			array('ed_id' => '2','xml_id' => 'acs0000001-01-i025','public' => '0','featured' => '0','seriesstmt' => '1','titlestmt_title' => 'Swinbourne Fake edition','titlestmt_author' => NULL,'titlestmt_editor' => NULL,'titlestmt_respstmt' => NULL,'publicationstmt_publisher' => NULL,'publicationstmt_pubplace' => NULL,'publicationstmt_date' => NULL,'publicationstmt_authority' => NULL,'publicationstmt_availability' => NULL,'sourcedesc_biblstruct_analytic_title' => NULL,'sourcedesc_biblstruct_analytic_author' => NULL,'sourcedesc_biblstruct_analytic_editor' => NULL,'sourcedesc_biblstruct_monogr_title' => NULL,'sourcedesc_biblstruct_monogr_imprint_pubplace' => NULL,'sourcedesc_biblstruct_monogr_imprint_publisher' => NULL,'sourcedesc_biblstruct_monogr_imprint_date' => NULL,'sourcedesc_biblstruct_monogr_imprint_biblscope_vol' => NULL,'sourcedesc_biblstruct_monogr_imprint_biblscope_pp' => NULL,'sourcedesc_biblstruct_monogr_extent' => NULL,'sourcedesc_biblstruct_idno' => NULL),
			array('ed_id' => '3','xml_id' => 'mixed-001','public' => '1','featured' => '0','seriesstmt' => '2','titlestmt_title' => 'Famous Paintings of Raffaello Sanzio','titlestmt_author' => NULL,'titlestmt_editor' => NULL,'titlestmt_respstmt' => NULL,'publicationstmt_publisher' => NULL,'publicationstmt_pubplace' => 'Rome, Italy','publicationstmt_date' => NULL,'publicationstmt_authority' => NULL,'publicationstmt_availability' => '<p>An Imbrex edition demo with&nbsp;some important paintings.</p>','sourcedesc_biblstruct_analytic_title' => NULL,'sourcedesc_biblstruct_analytic_author' => NULL,'sourcedesc_biblstruct_analytic_editor' => NULL,'sourcedesc_biblstruct_monogr_title' => NULL,'sourcedesc_biblstruct_monogr_imprint_pubplace' => NULL,'sourcedesc_biblstruct_monogr_imprint_publisher' => NULL,'sourcedesc_biblstruct_monogr_imprint_date' => NULL,'sourcedesc_biblstruct_monogr_imprint_biblscope_vol' => NULL,'sourcedesc_biblstruct_monogr_imprint_biblscope_pp' => NULL,'sourcedesc_biblstruct_monogr_extent' => NULL,'sourcedesc_biblstruct_idno' => NULL),
			array('ed_id' => '4','xml_id' => 'mixed-002','public' => '1','featured' => '0','seriesstmt' => '2','titlestmt_title' => 'Medieval Documents and Illuminated Manuscripts','titlestmt_author' => NULL,'titlestmt_editor' => NULL,'titlestmt_respstmt' => NULL,'publicationstmt_publisher' => NULL,'publicationstmt_pubplace' => NULL,'publicationstmt_date' => NULL,'publicationstmt_authority' => NULL,'publicationstmt_availability' => NULL,'sourcedesc_biblstruct_analytic_title' => 'Medieval Documents and Illuminated Manuscripts','sourcedesc_biblstruct_analytic_author' => NULL,'sourcedesc_biblstruct_analytic_editor' => NULL,'sourcedesc_biblstruct_monogr_title' => NULL,'sourcedesc_biblstruct_monogr_imprint_pubplace' => 'Naples','sourcedesc_biblstruct_monogr_imprint_publisher' => NULL,'sourcedesc_biblstruct_monogr_imprint_date' => NULL,'sourcedesc_biblstruct_monogr_imprint_biblscope_vol' => NULL,'sourcedesc_biblstruct_monogr_imprint_biblscope_pp' => NULL,'sourcedesc_biblstruct_monogr_extent' => NULL,'sourcedesc_biblstruct_idno' => NULL)
			),
			'imbrex_analytic_author' => array(
				array('author_id' => '1','ed_id' => '1','type' => 'pers','name' => 'Swinburne, Algernon Charles','key' => 'acs')
			),

			'imbrex_biblstruct_idno' => array(
				array('idno_id' => '1','ed_id' => '1','type' => 'URI','idno' => 'http://mith.umd.edu/tile/sampledata/swinburne.xml'),
				array('idno_id' => '2','ed_id' => '4','type' => 'ISBN','idno' => '123456789')
			),
			
			'imbrex_publicationstmt_publisher' => array(
				array('publisher_id' => '1','ed_id' => '1','publisher' => 'Institute for Digital Arts and Humanities','address' => 'Herman B Wells Library E170, 1320 E 10th St, Bloomington (Indiana), 47405','target' => 'http://www.indiana.edu/~idah/'),
				array('publisher_id' => '2','ed_id' => '1','publisher' => 'Digital Library Program','address' => '','target' => 'http://www.dlib.indiana.edu/'),
				array('publisher_id' => '3','ed_id' => '1','publisher' => 'Indiana University','address' => '107 S Indiana Ave, Bloomington, IN 47405, Stati Uniti','target' => 'http://www.indiana.edu/'),
				array('publisher_id' => '4','ed_id' => '4','publisher' => '','address' => '','target' => '')
			),	
					
			'imbrex_titlestmt_author' => array(
				array('author_id' => '1','ed_id' => '1','type' => 'pers','name' => 'Algernon Charles Swinburne','key' => 'acs'),
				array('author_id' => '2','ed_id' => '1','type' => 'pers','name' => 'Michael London','key' => 'ml'),
				array('author_id' => '3','ed_id' => '3','type' => 'pers','name' => 'Reffaello Sanzio','key' => 'rsan'),
				array('author_id' => '4','ed_id' => '4','type' => 'pers','name' => 'Alfredo Cosco','key' => 'alfcsc')
			),
			
			'imbrex_titlestmt_editor' => array(
				array('editor_id' => '1','ed_id' => '1','type' => 'pers','name' => 'John A. Walsh','key' => 'jawalsh'),
				array('editor_id' => '2','ed_id' => '1','type' => 'pers','name' => 'Peter Roma','key' => 'prm'),
				array('editor_id' => '3','ed_id' => '3','type' => 'org','name' => 'Wikipedia','key' => 'wkp')
			),
			'imbrex_titlestmt_respstmt' => array(
				array('resp_id' => '1','ed_id' => '1','resp' => 'Transcript by','type' => 'pers','name' => 'John Smith','key' => 'jsm')
			),
		
		//Edition S2
			'imbrex_text' => array(
				array('text_id' => '1','xml_id' => '1','text_type' => 'poem','text_lang' => '123','body_note' => '<p>Epigraph is a verse by Sappho in ancient greek</p>','linebreak' => '1','page_id' => NULL),
				array('text_id' => '5','xml_id' => '2','text_type' => 'poem','text_lang' => NULL,'body_note' => NULL,'linebreak' => '1','page_id' => NULL),
				array('text_id' => '6','xml_id' => '3','text_type' => 'book','text_lang' => '123','body_note' => '','linebreak' => '0','page_id' => NULL),
				array('text_id' => '7','xml_id' => '4','text_type' => 'document','text_lang' => '246','body_note' => NULL,'linebreak' => '1','page_id' => NULL)
			),
		
		//Pages & Tiles	
			'imbrex_text_body_lg' => array(
				array('page_id' => '1','xml_id' => '1','file' => '2e810-acs0000001-01-100.jpg','pagenum' => '57','linebreaks' => '1','pagecontent' => 'ANACTORIA
τίνος αὖ τὺ πειθοῖ
μὰψ σαγηνεύσας φιλόταταϗ
Sappho.
My life is bitter with thy love; thine eyes
Blind me, thy tresses burn me, thy sharp sighs
Divide my flesh and spirit with soft sound,
And my blood strengthens, and my veins abound.
I pray thee sigh not, speak not, draw not breath;
Let life burn down, and dream it is not death.
I would the sea had hidden us, the fire
(Wilt thou fear that, and fear not my desire?)
Severed the bones that bleach, the flesh that cleaves,
And let our sifted ashes drop like leaves.
I feel thy blood against my blood: my pain
Pains thee, and lips bruise lips, and vein stings vein.
Let fruit be crushed on fruit, let flower on flower,
Breast kindle breast, and either burn one hour.
Why wilt thou follow lesser loves? are thine
Too weak to bear these hands and lips of mine?
I charge thee for my life\'s sake, O too sweet
To crush love with thy cruel faultless feet,
I charge thee keep thy lips from hers or his,
Sweetest, till theirs be sweeter than my kiss:
Lest I too lure, a swallow for a dove,
Erotion or Erinna to my love.','closed' => '1','shapes' => NULL,'selections' => NULL,'labels' => NULL,'text_id' => '1'),
				array('page_id' => '2','xml_id' => '1','file' => 'ee88c-acs0000001-01-101.jpg','pagenum' => '58','linebreaks' => '1','pagecontent' => 'I would my love could kill thee; I am satiated
With seeing the live, and fain would have thee dead.
I would earth had thy body as fruit to eat,
And no mouth but some serpent\'s found thee sweet.
I would find grievous ways to have thee slain,
Intense device, and superflux of pain;
Vex thee with amorous agonies, and shake
Life at thy lips, and leave it there to ache;
Strain out thy soul with pangs too soft to kill,
Intolerable interludes, and infinite ill;
Relapse and reluctation of the breath,
Dumb tunes and shuddering semitones of death.
I am weary of all thy words and soft strange ways,
Of all love\'s fiery nights and all his days,
And all the broken kisses salt as brine
That shuddering lips make moist with waterish wine,
And eyes the bluer for all those hidden hours
That pleasure fills with tears and feeds from flowers,
Fierce at the heart with fire that half comes through,
But all the flowerlike white stained round with blue;
The fervent underlid, and that above
Lifted with laughter or abashed with love;
Thine amorous girdle, full of thee and fair,
And leavings of the lilies in thine hair.
Yea, all sweet words of thine and all thy ways,
And all the fruit of nights and flower of days,
And stinging lips wherein the hot sweet brine
That Love was born of burns and foams like wine,
And eyes insatiable of amorous hours,
Fervent as fire and delicate as flowers,
Coloured like night at heart, but cloven through
Like night with flame, dyed round like night with blue,','closed' => '1','shapes' => NULL,'selections' => NULL,'labels' => NULL,'text_id' => '1'),
				array('page_id' => '3','xml_id' => '1','file' => '75919-acs0000001-01-102.jpg','pagenum' => '59','linebreaks' => '1','pagecontent' => NULL,'closed' => '0','shapes' => NULL,'selections' => NULL,'labels' => NULL,'text_id' => '1'),
				array('page_id' => '6','xml_id' => '3','file' => '7b177-sanzio_01_plato_aristotle.jpg','pagenum' => '1','linebreaks' => '1','pagecontent' => 'The School of Athens

In the center of the fresco, at its architecture\'s central vanishing point, are the two undisputed main subjects: Plato on the left and Aristotle, his student, on the right. Both figures hold modern (of the time), bound copies of their books in their left hands, while gesturing with their right. Plato holds Timaeus, Aristotle his Nicomachean Ethics. Plato is depicted as old, grey, wise-looking, and bare-foot. By contrast Aristotle, slightly ahead of him, is in mature manhood, handsome, well-shod and dressed with gold, and the youth about them seem to look his way. In addition, these two central figures gesture along different dimensions: Plato vertically, upward along the picture-plane, into the beautiful vault above; Aristotle on the horizontal plane at right-angles to the picture-plane (hence in strong foreshortening), initiating a powerful flow of space toward viewers.

(source: https://en.wikipedia.org/wiki/The_School_of_Athens)','closed' => '1','shapes' => NULL,'selections' => NULL,'labels' => NULL,'text_id' => '6'),
				array('page_id' => '9','xml_id' => '3','file' => '2973b-raffaello_sanzio_-_madonna_del_cardellino_-_google_art_project.jpg','pagenum' => '2','linebreaks' => '1','pagecontent' => 'Madonna del Cardellino

In this painting, as in most of the Madonnas of his Florentine period, Raphael arranged the three figures - Mary, Christ and the young John the Baptist - to fit into a geometrical design. Though the positions of the three bodies are natural, together they form an almost regular triangle. The Madonna is shown young and beautiful, as with Raphael’s various other Madonnas. She is also clothed in red and blue, also typical, for red signifies the passion of Christ and blue was used to signify the church. Christ and John are still very young, only babies. John holds a goldfinch in his hand, and Christ is reaching out to touch it. The background is one typical of Raphael. The natural setting is diverse and yet all calmly frames the central subject taking place.

(source: https://en.wikipedia.org/wiki/Madonna_del_cardellino )

','closed' => '1','shapes' => NULL,'selections' => NULL,'labels' => NULL,'text_id' => '6'),
				array('page_id' => '10','xml_id' => '1','file' => NULL,'pagenum' => '60','linebreaks' => '0','pagecontent' => 'empty','closed' => '0','shapes' => NULL,'selections' => NULL,'labels' => NULL,'text_id' => '1'),
				array('page_id' => '11','xml_id' => '2','file' => NULL,'pagenum' => '1','linebreaks' => '0','pagecontent' => 'empty','closed' => '0','shapes' => NULL,'selections' => NULL,'labels' => NULL,'text_id' => '5'),
				array('page_id' => '12','xml_id' => '4','file' => 'd8040-giubileo-1300-bolla-antiquorum-habet-fida-relatio-bonifacio-viii-.png','pagenum' => '1','linebreaks' => '1','pagecontent' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
Vestibulum vitae tellus sit amet leo suscipit porttitor eu viverra nisi. 
Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed sit amet magna neque. Suspendisse lacinia ex sit amet tellus placerat,
 non egestas lacus ultrices. Aenean nec est luctus, egestas nulla ac, volutpat purus. 
Mauris feugiat massa quam, eu porta diam egestas vitae. Pellentesque id urna eget
turpis eleifend luctus. Maecenas tincidunt facilisis est nec mollis. Sed vel leo ac tortor
 eleifend imperdiet vel congue enim. Morbi et dui eget arcu dapibus vestibulum. 
Nunc gravida vehicula sem id tincidunt. Maecenas vel est vel nulla tempor sodales vel eu lacus. 
Interdum et malesuada fames ac ante ipsum primis in faucibus. Proin gravida eros vitae sollicitudin convallis.

Donec non risus neque. Ut venenatis sem a libero ultrices facilisis. 
Nunc tempus dolor at velit dictum, vel cursus justo iaculis. Curabitur at arcu magna. 
Nunc non turpis mi. Sed ornare lacus felis, ut scelerisque mi scelerisque vitae. 
Etiam eget nisl non libero ultricies feugiat nec eu nibh. Mauris dapibus tincidunt enim.
Aenean sed venenatis purus. Nulla sit amet malesuada neque, vitae sodales nunc.

Cras in tellus at nisi tempor malesuada. Donec auctor sed sem sit amet tincidunt.
 Integer quam ante, mollis ut sapien id, dictum fermentum ipsum. 
Nulla vulputate viverra arcu, at commodo est auctor non. Etiam nec scelerisque
 metus. Suspendisse sit amet mi dignissim, gravida odio vitae, sagittis enim. 
Sed metus dolor, suscipit interdum est at, posuere luctus massa.
','closed' => '1','shapes' => NULL,'selections' => NULL,'labels' => NULL,'text_id' => '7'),
				array('page_id' => '13','xml_id' => '4','file' => '1808e-meister_des_marechal_de_boucicaut_001.jpg','pagenum' => '2','linebreaks' => '1','pagecontent' => 'Duis sed ex commodo, maximus ligula ut, pretium ante. 
Duis orci quam, tempor sed ante sed, ultricies imperdiet justo. 
Interdum et malesuada fames ac ante ipsum primis in faucibus. 
Praesent sit amet sem felis. Nulla facilisi. Ut odio tellus, pulvinar ut posuere
 congue, elementum id eros. Nam metus eros, ullamcorper ac arcu vel, 
ullamcorper ullamcorper orci. Vestibulum tristique rhoncus est sed sagittis. 
Mauris tincidunt egestas dui, nec volutpat ante consectetur faucibus. 
Etiam facilisis, sem quis aliquam imperdiet, ante augue placerat turpis, 
vel blandit mi odio nec lacus. 
Quisque quis dui sit amet lectus egestas ultrices. 
Nunc fermentum eros ultricies, mollis eros nec, fermentum metus.
 Phasellus congue libero vel risus consectetur sagittis.','closed' => '1','shapes' => NULL,'selections' => NULL,'labels' => NULL,'text_id' => '7')
			),

			'imbrex_page_labels' => array(
			  array('label_id' => '776','page_id' => '1','id' => 'l_66','name' => 'title','selections' => 'anno_Be4qhn2h','shapes' => '1476807741467_0'),
			  array('label_id' => '777','page_id' => '1','id' => 'l_542','name' => 'epigraph','selections' => 'anno_duRnVyDo','shapes' => '1476807793431_0'),
			  array('label_id' => '778','page_id' => '1','id' => 'l_234','name' => 'persName','selections' => 'anno_nmck5qXX,anno_tLO5AX9i,anno_J5hNwm3k','shapes' => '1476807849307_0,1476809029846_0,1476809081644_0'),
			  array('label_id' => '779','page_id' => '1','id' => 'l_555','name' => 'head','selections' => NULL,'shapes' => '1476808005747_1'),
			  array('label_id' => '780','page_id' => '2','id' => 'l_66','name' => 'title','selections' => NULL,'shapes' => '1476891630314_1'),
			  array('label_id' => '832','page_id' => '6','id' => 'l_229','name' => 'title','selections' => 'anno_aMPSaKVp','shapes' => NULL),
			  array('label_id' => '833','page_id' => '6','id' => 'l_100','name' => 'philosopher','selections' => 'anno_qBLPd1EM,anno_LyPHnT9t,anno_B8TUUQ2F','shapes' => '1477419490975_0,1477419593847_0'),
			  array('label_id' => '834','page_id' => '6','id' => 'l_513','name' => 'Plato','selections' => NULL,'shapes' => '1477419490975_0'),
			  array('label_id' => '835','page_id' => '6','id' => 'l_254','name' => 'Leonardo da Vinci','selections' => NULL,'shapes' => '1477419490975_0'),
			  array('label_id' => '836','page_id' => '6','id' => 'l_420','name' => 'Aristotle','selections' => 'anno_B8TUUQ2F','shapes' => '1477419593847_0'),
			  array('label_id' => '837','page_id' => '6','id' => 'l_370','name' => 'Bastiano da Sangallo','selections' => NULL,'shapes' => '1477419593847_0'),
			  array('label_id' => '838','page_id' => '6','id' => 'l_498','name' => 'book','selections' => 'anno_CBxytkdg,anno_AqfqOGI1','shapes' => '1477419675313_0,1477419732544_0'),
			  array('label_id' => '839','page_id' => '6','id' => 'l_417','name' => 'Timaeus','selections' => NULL,'shapes' => '1477419675313_0'),
			  array('label_id' => '840','page_id' => '6','id' => 'l_363','name' => ' Nicomachean Ethics','selections' => NULL,'shapes' => '1477419732544_0'),
			  array('label_id' => '841','page_id' => '9','id' => 'l_229','name' => 'title','selections' => 'anno_mGh9UwqB','shapes' => NULL),
			  array('label_id' => '842','page_id' => '9','id' => 'l_160','name' => 'Mary','selections' => 'anno_OfiQo0rz','shapes' => '1477428764794_0'),
			  array('label_id' => '843','page_id' => '9','id' => 'l_396','name' => 'Christ','selections' => 'anno_4sHpnEWq','shapes' => '1477428841933_0'),
			  array('label_id' => '844','page_id' => '9','id' => 'l_38','name' => 'John the Baptist','selections' => 'anno_JvN11Upo,anno_o09F1EFt,anno_HANsNzuI','shapes' => '1477428899123_0'),
			  array('label_id' => '845','page_id' => '9','id' => 'l_65','name' => 'goldfinch','selections' => 'anno_CP59Fc3a','shapes' => '1477866276289_1'),
			  array('label_id' => '846','page_id' => '12','id' => 'l_436','name' => 'protocollo','selections' => 'anno_8846ptI0','shapes' => '1478044767930_0'),
			  array('label_id' => '847','page_id' => '12','id' => 'l_364','name' => 'testo','selections' => 'anno_HpFUmJDM','shapes' => '1478044858161_0'),
			  array('label_id' => '848','page_id' => '12','id' => 'l_490','name' => 'escatocollo','selections' => 'anno_pxQLASKE','shapes' => '1478044952391_0'),
			  array('label_id' => '849','page_id' => '13','id' => 'l_555','name' => 'illustrazione','selections' => NULL,'shapes' => '1478045007081_0'),
			  array('label_id' => '850','page_id' => '13','id' => 'l_272','name' => 'capolettera','selections' => NULL,'shapes' => '1478045072557_1'),
			  array('label_id' => '851','page_id' => '13','id' => 'l_364','name' => 'testo','selections' => NULL,'shapes' => '1478045132294_1')
			),
			
			'imbrex_text_selections' => array(
			  array('selection_id' => '783','page_id' => '1','id' => 'anno_Be4qhn2h','startparent' => 'div#line0','startoffset' => '0','startchild' => '0','endparent' => 'div#line0','endoffset' => '9','endchild' => '0','color' => '#FDFF00','labels' => 'l_66'),
			  array('selection_id' => '784','page_id' => '1','id' => 'anno_duRnVyDo','startparent' => 'div#line1','startoffset' => '0','startchild' => '0','endparent' => 'div#line2','endoffset' => '24','endchild' => '0','color' => '#12e844','labels' => 'l_542'),
			  array('selection_id' => '785','page_id' => '1','id' => 'anno_nmck5qXX','startparent' => 'div#line3','startoffset' => '0','startchild' => '0','endparent' => 'div#line3','endoffset' => '6','endchild' => '0','color' => '#9be610','labels' => 'l_234'),
			  array('selection_id' => '786','page_id' => '1','id' => 'anno_tLO5AX9i','startparent' => 'div#line25','startoffset' => '0','startchild' => '0','endparent' => 'div#line25','endoffset' => '7','endchild' => '0','color' => '#eda5c3','labels' => 'l_234'),
			  array('selection_id' => '787','page_id' => '1','id' => 'anno_J5hNwm3k','startparent' => 'div#line25','startoffset' => '11','startchild' => '0','endparent' => 'div#line25','endoffset' => '17','endchild' => '0','color' => '#a5a8e8','labels' => 'l_234'),
			  array('selection_id' => '820','page_id' => '6','id' => 'anno_aMPSaKVp','startparent' => 'div#line0','startoffset' => '0','startchild' => '0','endparent' => 'div#line0','endoffset' => '20','endchild' => '0','color' => '#FDFF00','labels' => 'l_229'),
			  array('selection_id' => '821','page_id' => '6','id' => 'anno_qBLPd1EM','startparent' => 'div#line2','startoffset' => '114','startchild' => '0','endparent' => 'div#line2','endoffset' => '119','endchild' => '0','color' => '#f011f0','labels' => 'l_100'),
			  array('selection_id' => '822','page_id' => '6','id' => 'anno_LyPHnT9t','startparent' => 'div#line2','startoffset' => '136','startchild' => '0','endparent' => 'div#line2','endoffset' => '145','endchild' => '0','color' => '#ed0eed','labels' => 'l_100'),
			  array('selection_id' => '823','page_id' => '6','id' => 'anno_CBxytkdg','startparent' => 'div#line2','startoffset' => '309','startchild' => '0','endparent' => 'div#line2','endoffset' => '316','endchild' => '0','color' => '#11eda4','labels' => 'l_498'),
			  array('selection_id' => '824','page_id' => '6','id' => 'anno_AqfqOGI1','startparent' => 'div#line2','startoffset' => '332','startchild' => '0','endparent' => 'div#line2','endoffset' => '350','endchild' => '0','color' => '#12e39d','labels' => 'l_498'),
			  array('selection_id' => '825','page_id' => '6','id' => 'anno_B8TUUQ2F','startparent' => 'div#line2','startoffset' => '425','startchild' => '0','endparent' => 'div#line2','endoffset' => '434','endchild' => '0','color' => '#FDFF00','labels' => 'l_420,l_100'),
			  array('selection_id' => '826','page_id' => '9','id' => 'anno_mGh9UwqB','startparent' => 'div#line0','startoffset' => '0','startchild' => '0','endparent' => 'div#line0','endoffset' => '22','endchild' => '0','color' => '#FDFF00','labels' => 'l_229'),
			  array('selection_id' => '827','page_id' => '9','id' => 'anno_OfiQo0rz','startparent' => 'div#line2','startoffset' => '108','startchild' => '0','endparent' => 'div#line2','endoffset' => '112','endchild' => '0','color' => '#f20c3e','labels' => 'l_160'),
			  array('selection_id' => '828','page_id' => '9','id' => 'anno_4sHpnEWq','startparent' => 'div#line2','startoffset' => '114','startchild' => '0','endparent' => 'div#line2','endoffset' => '120','endchild' => '0','color' => '#0ef0d2','labels' => 'l_396'),
			  array('selection_id' => '829','page_id' => '9','id' => 'anno_JvN11Upo','startparent' => 'div#line2','startoffset' => '135','startchild' => '0','endparent' => 'div#line2','endoffset' => '151','endchild' => '0','color' => '#27ed11','labels' => 'l_38'),
			  array('selection_id' => '830','page_id' => '9','id' => 'anno_o09F1EFt','startparent' => 'div#line2','startoffset' => '516','startchild' => '0','endparent' => 'div#line2','endoffset' => '520','endchild' => '0','color' => '#28ed13','labels' => 'l_38'),
			  array('selection_id' => '831','page_id' => '9','id' => 'anno_HANsNzuI','startparent' => 'div#line2','startoffset' => '556','startchild' => '0','endparent' => 'div#line2','endoffset' => '560','endchild' => '0','color' => '#2bed15','labels' => 'l_38'),
			  array('selection_id' => '832','page_id' => '9','id' => 'anno_CP59Fc3a','startparent' => 'div#line2','startoffset' => '569','startchild' => '0','endparent' => 'div#line2','endoffset' => '578','endchild' => '0','color' => '#15cded','labels' => 'l_65'),
			  array('selection_id' => '833','page_id' => '12','id' => 'anno_8846ptI0','startparent' => 'div#line0','startoffset' => '0','startchild' => '0','endparent' => 'div#line1','endoffset' => '72','endchild' => '0','color' => '#11f769','labels' => 'l_436'),
			  array('selection_id' => '834','page_id' => '12','id' => 'anno_HpFUmJDM','startparent' => 'div#line2','startoffset' => '0','startchild' => '0','endparent' => 'div#line16','endoffset' => '81','endchild' => '0','color' => '#28d66b','labels' => 'l_364'),
			  array('selection_id' => '835','page_id' => '12','id' => 'anno_pxQLASKE','startparent' => 'div#line17','startoffset' => '1','startchild' => '0','endparent' => 'div#line20','endoffset' => '64','endchild' => '0','color' => '#0bb54c','labels' => 'l_490')
			),
			'imbrex_text_shapes' => array(
				  array('shape_id' => '558','page_id' => '1','id' => '1476807741467_0','type' => 'rect','_scale' => '1','color' => '#000000','posinfo_x_cx' => '368.84808525332','posinfo_y_cy' => '367.10041482143','posinfo_width_rx' => '217.96587130023','posinfo_height_ry' => '74.567271760603','labels' => 'l_66','lines' => NULL),
				  array('shape_id' => '559','page_id' => '1','id' => '1476807793431_0','type' => 'rect','_scale' => '0.617705126022','color' => '#10e642','posinfo_x_cx' => '213.609375','posinfo_y_cy' => '281','posinfo_width_rx' => '185','posinfo_height_ry' => '42','labels' => 'l_542','lines' => NULL),
				  array('shape_id' => '560','page_id' => '1','id' => '1476807849307_0','type' => 'rect','_scale' => '0.617705126022','color' => '#99e310','posinfo_x_cx' => '335.609375','posinfo_y_cy' => '319','posinfo_width_rx' => '81','posinfo_height_ry' => '19','labels' => 'l_234','lines' => NULL),
				  array('shape_id' => '561','page_id' => '1','id' => '1476808005747_1','type' => 'rect','_scale' => '1','color' => '#1d10de','posinfo_x_cx' => '196.87286032927','posinfo_y_cy' => '330.25466586906','posinfo_width_rx' => '560.13781564066','posinfo_height_ry' => '220.16977724604','labels' => 'l_555','lines' => ''),
				  array('shape_id' => '562','page_id' => '1','id' => '1476808279461_0','type' => 'rect','_scale' => '1','color' => '#000000','posinfo_x_cx' => '174.20832443629','posinfo_y_cy' => '759.26195241465','posinfo_width_rx' => '522.90322095934','posinfo_height_ry' => '29.140117576682','labels' => NULL,'lines' => 'line11'),
				  array('shape_id' => '563','page_id' => '1','id' => '1476809029846_0','type' => 'rect','_scale' => '0.74742320248662','color' => '#e8a5c1','posinfo_x_cx' => '132.609375','posinfo_y_cy' => '863','posinfo_width_rx' => '70','posinfo_height_ry' => '25','labels' => 'l_234','lines' => NULL),
				  array('shape_id' => '564','page_id' => '1','id' => '1476809081644_0','type' => 'rect','_scale' => '0.74742320248662','color' => '#a5a8e8','posinfo_x_cx' => '228.609375','posinfo_y_cy' => '864','posinfo_width_rx' => '57','posinfo_height_ry' => '24','labels' => 'l_234','lines' => NULL),
				  array('shape_id' => '571','page_id' => '2','id' => '1476891415221_0','type' => 'rect','_scale' => '1','color' => '#000000','posinfo_x_cx' => '243.82082753614','posinfo_y_cy' => '212.07530014141','posinfo_width_rx' => '540.71107058954','posinfo_height_ry' => '42.091280944096','labels' => NULL,'lines' => 'line0'),
				  array('shape_id' => '572','page_id' => '2','id' => '1476891436653_0','type' => 'rect','_scale' => '1','color' => '#000000','posinfo_x_cx' => '240.58303669429','posinfo_y_cy' => '246.07210398087','posinfo_width_rx' => '610.32357368939','posinfo_height_ry' => '40.472385523169','labels' => NULL,'lines' => 'line1'),
				  array('shape_id' => '573','page_id' => '2','id' => '1476891455832_0','type' => 'rect','_scale' => '1','color' => '#000000','posinfo_x_cx' => '243.82082753614','posinfo_y_cy' => '276.83111697848','posinfo_width_rx' => '498.61978964544','posinfo_height_ry' => '29.140117576682','labels' => NULL,'lines' => 'line2'),
				  array('shape_id' => '574','page_id' => '2','id' => '1476891630314_1','type' => 'rect','_scale' => '0.617705126022','color' => '#5df035','posinfo_x_cx' => '281.609375','posinfo_y_cy' => '97','posinfo_width_rx' => '110','posinfo_height_ry' => '31','labels' => 'l_66','lines' => NULL),
				  array('shape_id' => '597','page_id' => '6','id' => '1477419490975_0','type' => 'rect','_scale' => '0.4782969','color' => '#ed0eed','posinfo_x_cx' => '47.609375','posinfo_y_cy' => '17','posinfo_width_rx' => '150','posinfo_height_ry' => '476','labels' => 'l_100,l_513,l_254','lines' => NULL),
				  array('shape_id' => '598','page_id' => '6','id' => '1477419593847_0','type' => 'rect','_scale' => '0.4782969','color' => '#ed11ed','posinfo_x_cx' => '217.609375','posinfo_y_cy' => '9','posinfo_width_rx' => '155','posinfo_height_ry' => '482','labels' => 'l_100,l_420,l_370','lines' => NULL),
				  array('shape_id' => '599','page_id' => '6','id' => '1477419675313_0','type' => 'rect','_scale' => '0.4782969','color' => '#11eba2','posinfo_x_cx' => '141.609375','posinfo_y_cy' => '166','posinfo_width_rx' => '58','posinfo_height_ry' => '100','labels' => 'l_498,l_417','lines' => NULL),
				  array('shape_id' => '600','page_id' => '6','id' => '1477419732544_0','type' => 'rect','_scale' => '0.4782969','color' => '#12e09b','posinfo_x_cx' => '288.609375','posinfo_y_cy' => '212','posinfo_width_rx' => '92','posinfo_height_ry' => '82','labels' => 'l_498,l_363','lines' => NULL),
				  array('shape_id' => '601','page_id' => '9','id' => '1477428764794_0','type' => 'rect','_scale' => '0.59049','color' => '#f00e3f','posinfo_x_cx' => '112.609375','posinfo_y_cy' => '64','posinfo_width_rx' => '165','posinfo_height_ry' => '141','labels' => 'l_160','lines' => NULL),
				  array('shape_id' => '602','page_id' => '9','id' => '1477428841933_0','type' => 'rect','_scale' => '0.59049','color' => '#11edd0','posinfo_x_cx' => '198.609375','posinfo_y_cy' => '245','posinfo_width_rx' => '91','posinfo_height_ry' => '241','labels' => 'l_396','lines' => NULL),
				  array('shape_id' => '603','page_id' => '9','id' => '1477428899123_0','type' => 'rect','_scale' => '0.59049','color' => '#27ed11','posinfo_x_cx' => '77.609375','posinfo_y_cy' => '228','posinfo_width_rx' => '86','posinfo_height_ry' => '231','labels' => 'l_38','lines' => NULL),
				  array('shape_id' => '605','page_id' => '9','id' => '1477866276289_1','type' => 'ellipse','_scale' => '0.59049','color' => '#f7f311','posinfo_x_cx' => '169.609375','posinfo_y_cy' => '291','posinfo_width_rx' => '24','posinfo_height_ry' => '28','labels' => 'l_65','lines' => NULL),
				  array('shape_id' => '606','page_id' => '12','id' => '1478044767930_0','type' => 'rect','_scale' => '0.81','color' => '#11f769','posinfo_x_cx' => '22.609375','posinfo_y_cy' => '3','posinfo_width_rx' => '686','posinfo_height_ry' => '141','labels' => 'l_436','lines' => NULL),
				  array('shape_id' => '607','page_id' => '12','id' => '1478044858161_0','type' => 'rect','_scale' => '0.81','color' => '#2cd16b','posinfo_x_cx' => '30.609375','posinfo_y_cy' => '138','posinfo_width_rx' => '672','posinfo_height_ry' => '247','labels' => 'l_364','lines' => NULL),
				  array('shape_id' => '608','page_id' => '12','id' => '1478044952391_0','type' => 'rect','_scale' => '0.81','color' => '#0db34c','posinfo_x_cx' => '30.609375','posinfo_y_cy' => '384','posinfo_width_rx' => '677','posinfo_height_ry' => '59','labels' => 'l_490','lines' => NULL),
				  array('shape_id' => '609','page_id' => '13','id' => '1478045007081_0','type' => 'rect','_scale' => '0.3486784401','color' => '#f4fc05','posinfo_x_cx' => '57.609375','posinfo_y_cy' => '83','posinfo_width_rx' => '194','posinfo_height_ry' => '216','labels' => 'l_555','lines' => NULL),
				  array('shape_id' => '610','page_id' => '13','id' => '1478045072557_1','type' => 'rect','_scale' => '0.3486784401','color' => '#f2fa08','posinfo_x_cx' => '56.609375','posinfo_y_cy' => '309','posinfo_width_rx' => '101','posinfo_height_ry' => '77','labels' => 'l_272','lines' => NULL),
				  array('shape_id' => '611','page_id' => '13','id' => '1478045099217_2','type' => 'rect','_scale' => '0.3486784401','color' => '#fa0808','posinfo_x_cx' => '31.609375','posinfo_y_cy' => '299','posinfo_width_rx' => '257','posinfo_height_ry' => '143','labels' => '','lines' => NULL),
				  array('shape_id' => '612','page_id' => '13','id' => '1478045132294_1','type' => 'rect','_scale' => '0.3486784401','color' => '#fa0808','posinfo_x_cx' => '29.609375','posinfo_y_cy' => '299','posinfo_width_rx' => '253','posinfo_height_ry' => '139','labels' => 'l_364','lines' => NULL)
			),
);

    //////////////////////////////////////////////////////////////////////////////
    // ACTIVATION
    //////////////////////////////////////////////////////////////////////////////
    public function do_activate(){	
        // TODO : write your module activation script here
        $this->smart_copy (FCPATH."modules/imbrex_data/assets/images/",FCPATH."files/");

    }

    //////////////////////////////////////////////////////////////////////////////
    // DEACTIVATION
    //////////////////////////////////////////////////////////////////////////////
    public function do_deactivate(){
        // TODO : write your module deactivation script here
        //$this->db->truncate($this->t('imbrex_text_shapes'));
			$query = $this->db->query("SHOW TABLES");
			$rows=$query->result_array();

			$name = $this->db->database;

			foreach ($query->result_array() as $row)
			{
			  $table = $row['Tables_in_' . $name];
			  if(strstr($table, 'imbrex')){
				  $imbrex_tables[]=$table;
				  }
				
			}		  
			
			foreach ($imbrex_tables as $table)
			{
				$this->db->query("TRUNCATE " . $table);
				$this->db->query("ALTER TABLE ".$table." AUTO_INCREMENT = 1");
			}
			
			$this->rrmdir('files/1');
			$this->rrmdir('files/3');
			$this->rrmdir('files/4');		
    }

    //////////////////////////////////////////////////////////////////////////////
    // UPGRADE
    //////////////////////////////////////////////////////////////////////////////
    // TODO: write your upgrade function: do_upgrade_to_x_x_x

	//Recursive copy dir
	private function smart_copy($source, $dest, $options=array('folderPermission'=>0755,'filePermission'=>0755)) 
    { 
        $result=false; 
        
        if (is_file($source)) { 
            if ($dest[strlen($dest)-1]=='/') { 
                if (!file_exists($dest)) { 
                    cmfcDirectory::makeAll($dest,$options['folderPermission'],true); 
                } 
                $__dest=$dest."/".basename($source); 
            } else { 
                $__dest=$dest; 
            } 
            $result=copy($source, $__dest); 
            chmod($__dest,$options['filePermission']); 
            
        } elseif(is_dir($source)) { 
            if ($dest[strlen($dest)-1]=='/') { 
                if ($source[strlen($source)-1]=='/') { 
                    //Copy only contents 
                } else { 
                    //Change parent itself and its contents 
                    $dest=$dest.basename($source); 
                    @mkdir($dest); 
                    chmod($dest,$options['filePermission']); 
                } 
            } else { 
                if ($source[strlen($source)-1]=='/') { 
                    //Copy parent directory with new name and all its content 
                    @mkdir($dest,$options['folderPermission']); 
                    chmod($dest,$options['filePermission']); 
                } else { 
                    //Copy parent directory with new name and all its content 
                    @mkdir($dest,$options['folderPermission']); 
                    chmod($dest,$options['filePermission']); 
                } 
            } 

            $dirHandle=opendir($source); 
            while($file=readdir($dirHandle)) 
            { 
                if($file!="." && $file!="..") 
                { 
                     if(!is_dir($source."/".$file)) { 
                        $__dest=$dest."/".$file; 
                    } else { 
                        $__dest=$dest."/".$file; 
                    } 
                    $result=$this->smart_copy($source."/".$file, $__dest, $options); 
                } 
            } 
            closedir($dirHandle); 
            
        } else { 
            $result=false; 
        } 
        return $result; 
    }
    
    //recursive delete dir
    private function rrmdir($dir) { 
	   if (is_dir($dir)) { 
	     $objects = scandir($dir); 
	     foreach ($objects as $object) { 
	       if ($object != "." && $object != "..") { 
	         if (is_dir($dir."/".$object))
	           $this->rrmdir($dir."/".$object);
	         else
	           unlink($dir."/".$object); 
	       } 
	     }
	     rmdir($dir); 
	   } 
	 }

}
