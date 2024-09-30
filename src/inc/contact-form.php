<?php
function cspd_call_after_for_submit($contact_data)
{

  $contact_form = WPCF7_ContactForm::get_current();
  $contact_form_id = $contact_form->id;

  if ($contact_form_id == 592 || $contact_form_id == 678) {
    $relation = $_POST["relation"];
    $represent = $_POST["represent"];
    $people = $_POST["people"];
    $meaning = $_POST["meaning"];
    $description = $_POST["description"];
    $year = $_POST["yearCreate"];
    $month = $_POST["monthCreate"];
    $day = $_POST["dayCreate"];
    $photographers = $_POST["photographers"];
    $fornamn = $_POST["fornamn"];
    $efternamn = $_POST["efternamn"];
    $epost = $_POST["epost"];
    $contactways = $_POST["otherways"];
    $about = $_POST["aboutself"];
    $post_title = 'The interview series';
    $categoryID = 51;
    $content = '
        <!-- wp:heading {"level":2} -->
        <h2>Hur ser din relation till ditt familjearkiv: fotografier, filmklipp, ljudinspelningar, minnen, muntliga berättelser?</h2>
        <!-- /wp:heading -->
        <!-- wp:paragraph -->
        <p>' . $relation . '</p>
        <!-- /wp:paragraph -->
        <!-- wp:heading {"level":2} -->
        <h2>Du delar med dig av visuellt material som berör din familj. Vad representerar detta material för dig?</h2>
        <!-- /wp:heading -->
        <!-- wp:paragraph -->
        <p>' . $represent . '</p>
        <!-- /wp:paragraph -->
        <!-- wp:heading {"level":2} -->
        <h2>Beskriv kort personerna i bildmaterialet och situationen som avbildas, om möjligt</h2>
        <!-- /wp:heading -->
        <!-- wp:paragraph -->
        <p>' . $people . '</p>
        <!-- /wp:paragraph -->
        <!-- wp:heading {"level":2} -->
        <h2>Vad innebär ett Svart arkiv/Black archive för dig?</h2>
        <!-- /wp:heading -->
        <!-- wp:paragraph -->
        <p>' . $meaning . '</p>
        <!-- /wp:paragraph -->';
  } elseif ($contact_form_id == 637 || $contact_form_id == 679) {
    $description = $_POST["description"];
    $year = $_POST["yearCreate"];
    $month = $_POST["monthCreate"];
    $day = $_POST["dayCreate"];
    $photographers = $_POST["photographers"];
    $fornamn = $_POST["fornamn"];
    $efternamn = $_POST["efternamn"];
    $epost = $_POST["epost"];
    $contactways = $_POST["otherways"];
    $about = $_POST["aboutself"];
    $content = '<!-- wp:heading {"level":2} -->
        <h2>Om fotografierna</h2>
        <!-- /wp:heading -->
        <!-- wp:paragraph -->
        <p>' . $description . '</p>
        <!-- /wp:paragraph -->
        ';
    $post_title = 'Family Photo album';
    $categoryID = 49;
  }

  $name = $fornamn . " " . $efternamn;
  $date = $year . " " . $month . " " . $day;
  // create new CPT

  $submission = WPCF7_Submission::get_instance();
  if (!$submission) {
    return;
  }
  $posted_data = $submission->get_posted_data();

  $new_post = array();
  $new_post['post_title'] = $post_title . " - submitted by: " . $fornamn . " " . $efternamn;
  $new_post['post_type'] = 'post';
  $new_post['post_content'] = $content;
  $new_post['post_status'] = 'draft';

  //When everything is prepared, insert the post into your WordPress Database
  $post_id = wp_insert_post($new_post);


  update_field('field_6041d8dc93430', $name, $post_id); // author
  update_field('field_633dc189232bf', $epost, $post_id); // e-post
  update_field('field_633dc1a8232c1', $contactways, $post_id); // annan kontaktväg
  update_field('field_633dc1bd232c2', $about, $post_id); // about
  update_field('field_633dce2712b47', $photographers, $post_id); // fotografer
  update_field('field_633dd06a6da81', $date, $post_id); // date
  return;
}
add_action('wpcf7_before_send_mail', 'cspd_call_after_for_submit');

function suppress_wpcf7_filter($value, $sub = "")
{
  $out    =   !empty($sub) ? $sub : $value;
  $out    =   strip_tags($out);
  $out    =   wptexturize($out);
  return $out;
}
add_filter("wpcf7_mail_tag_replaced", "suppress_wpcf7_filter");
