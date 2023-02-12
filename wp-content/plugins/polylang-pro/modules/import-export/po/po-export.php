<?php
/**
 * @package Polylang-Pro
 */

/**
 * PO file, generated from exporting Polylang translations
 *
 * Handles the construction of a PO files.
 *
 * @since 2.7
 */
class PLL_PO_Export extends PLL_Export_File {

	/**
	 * The registered target language.
	 *
	 * @var string
	 */
	protected $target_language = '';

	/**
	 * The registered source language.
	 *
	 * @var string
	 */
	protected $source_language = '';

	/**
	 * The registered site reference.
	 *
	 * @var string
	 */
	protected $site_reference = '';

	/**
	 * Po object.
	 *
	 * @var PO
	 */
	private $po;

	/**
	 * PLL_Export_Interface constructor.
	 * Creates a PO object.
	 *
	 * @since 2.7
	 */
	public function __construct() {
		require_once ABSPATH . '/wp-includes/pomo/po.php';
		$this->po = new PO();
	}

	/**
	 * @since 3.1
	 *
	 * @return string
	 */
	public function get_source_language() {
		return $this->source_language;
	}

	/**
	 * Set a source language to the export
	 *
	 * @since 2.7
	 *
	 * @param string $source_language Locale.
	 * @return void
	 */
	public function set_source_language( $source_language ) {
		$this->source_language = $source_language;
	}

	/**
	 * @since 3.1
	 *
	 * @return string
	 */
	public function get_target_language() {
		return $this->target_language;
	}

	/**
	 * Set a target language to the export
	 *
	 * @since 2.7
	 *
	 * @param string $target_language Target language.
	 * @return void
	 */
	public function set_target_language( $target_language ) {
		$this->target_language = $target_language;
	}

	/**
	 * Set the site reference to the export.
	 *
	 * @since 2.7
	 *
	 * @param string $url Absolute url of the current site.
	 * @return void
	 */
	public function set_site_reference( $url ) {
		$this->site_reference = $url;
	}

	/**
	 * Add a translation source and target to the current translation file
	 *
	 * @since 2.7
	 *
	 * @param string $type   Describe what does this data corresponds to, such as a post title, a meta reference etc...
	 * @param string $source The source to be translated.
	 * @param string $target Optional, preexisting translation, if any.
	 * @param array  $args   Optional, an array containing the name and the context of the string.
	 * @return void
	 */
	public function add_translation_entry( $type, $source, $target = '', $args = array() ) {
		$entry = new Translation_Entry(
			array(
				'singular'           => $source,
				'translations'       => array( $target ),
				'context'            => isset( $args['context'] ) ? $args['context'] : null,
				'extracted_comments' => isset( $args['id'] ) ? $args['id'] : '',
			)
		);

		$this->po->add_entry( $entry );
	}

	/**
	 * Assign a reference to the PO file.
	 *
	 * @since 2.7
	 * @since 3.3.1 Remove unused source reference header.
	 *
	 * @param string $type Type of data to be exported.
	 * @param string $id   Optional, unique identifier to retrieve the data in the database.
	 * @return void
	 */
	public function set_source_reference( $type, $id = '' ) { // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable
	}

	/**
	 * Writes the file in the output buffer
	 *
	 * @since 2.7
	 *
	 * @return string
	 */
	public function export() {
		$this->po->set_comment_before_headers( $this->get_comment_before_headers() );

		$this->set_file_headers();

		return $this->po->export();
	}

	/**
	 * Assigns the necessary headers to the PO file.
	 *
	 * @see https://www.gnu.org/software/trans-coord/manual/gnun/html_node/PO-Header.html
	 *
	 * @since 2.7
	 * @since 3.3   Add a reference to the application that generated the export file (name + version).
	 * @since 3.3.1 Replace non-official "Language-Target" header to the official Language.
	 *              Use the Poedit header "X-Source-Language" instead of non official "Language-source".
	 *              Replace non official 'Site-Reference" header by "X-Polylang-Site-Reference".
	 * @return void
	 */
	protected function set_file_headers() {
		$this->po->set_header( 'Language', $this->target_language );
		$this->po->set_header( 'Project-Id-Version', PLL_Import_Export::APP_NAME . '/' . POLYLANG_VERSION );
		$this->po->set_header( 'POT-Creation-Date', current_time( 'Y-m-d H:iO', true ) );
		$this->po->set_header( 'PO-Revision-Date', current_time( 'Y-m-d H:iO', true ) );
		$this->po->set_header( 'MIME-Version', '1.0' );
		$this->po->set_header( 'Content-Type', 'text/plain; charset=utf-8' );
		$this->po->set_header( 'Content-Transfer-Encoding', '8bit' );
		$this->po->set_header( 'X-Source-Language', $this->source_language );
		$this->po->set_header( 'X-Polylang-Site-Reference', $this->site_reference );
	}

	/**
	 *
	 * Get the necessary text comment to add to the PO file.
	 *
	 * @return string
	 */
	protected function get_comment_before_headers() {
		$po = 'This file was generated by ' . POLYLANG . PHP_EOL;
		$po .= 'https://polylang.pro/' . PHP_EOL;

		return $po;
	}

	/**
	 * @since 3.1
	 *
	 * @return string
	 */
	public function get_extension() {
		return 'po';
	}
}