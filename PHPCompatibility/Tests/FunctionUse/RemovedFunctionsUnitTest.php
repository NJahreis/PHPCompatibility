<?php
/**
 * PHPCompatibility, an external standard for PHP_CodeSniffer.
 *
 * @package   PHPCompatibility
 * @copyright 2012-2020 PHPCompatibility Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCompatibility/PHPCompatibility
 */

namespace PHPCompatibility\Tests\FunctionUse;

use PHPCompatibility\Tests\BaseSniffTest;

/**
 * Test the RemovedFunctions sniff.
 *
 * @group removedFunctions
 * @group functionUse
 *
 * @covers \PHPCompatibility\Sniffs\FunctionUse\RemovedFunctionsSniff
 *
 * @since 5.5
 */
class RemovedFunctionsUnitTest extends BaseSniffTest
{

    /**
     * testDeprecatedFunction
     *
     * @dataProvider dataDeprecatedFunction
     *
     * @param string $functionName      Name of the function.
     * @param string $deprecatedIn      The PHP version in which the function was deprecated.
     * @param array  $lines             The line numbers in the test file which apply to this function.
     * @param string $okVersion         A PHP version in which the function was still valid.
     * @param string $deprecatedVersion Optional PHP version to test deprecation message with -
     *                                  if different from the $deprecatedIn version.
     *
     * @return void
     */
    public function testDeprecatedFunction($functionName, $deprecatedIn, $lines, $okVersion, $deprecatedVersion = null)
    {
        $file = $this->sniffFile(__FILE__, $okVersion);
        foreach ($lines as $line) {
            $this->assertNoViolation($file, $line);
        }

        $errorVersion = (isset($deprecatedVersion)) ? $deprecatedVersion : $deprecatedIn;
        $file         = $this->sniffFile(__FILE__, $errorVersion);
        $error        = "Function {$functionName}() is deprecated since PHP {$deprecatedIn}";
        foreach ($lines as $line) {
            $this->assertWarning($file, $line, $error);
        }
    }

    /**
     * Data provider.
     *
     * @see testDeprecatedFunction()
     *
     * @return array
     */
    public function dataDeprecatedFunction()
    {
        return array(
            array('dl', '5.3', array(6), '5.2'),
            array('ocifetchinto', '5.4', array(63), '5.3'),
            array('ldap_sort', '7.0', array(97), '5.6'),
            array('fgetss', '7.3', array(167), '7.2'),
            array('gzgetss', '7.3', array(168), '7.2'),
            array('ezmlm_hash', '7.4', array(245), '7.3'),
            array('get_magic_quotes_gpc', '7.4', array(240), '7.3'),
            array('get_magic_quotes_runtime', '7.4', array(241), '7.3'),
            array('hebrevc', '7.4', array(242), '7.3'),
        );
    }


    /**
     * testDeprecatedFunctionWithAlternative
     *
     * @dataProvider dataDeprecatedFunctionWithAlternative
     *
     * @param string $functionName      Name of the function.
     * @param string $deprecatedIn      The PHP version in which the function was deprecated.
     * @param string $alternative       An alternative function.
     * @param array  $lines             The line numbers in the test file which apply to this function.
     * @param string $okVersion         A PHP version in which the function was still valid.
     * @param string $deprecatedVersion Optional PHP version to test deprecation message with -
     *                                  if different from the $deprecatedIn version.
     *
     * @return void
     */
    public function testDeprecatedFunctionWithAlternative($functionName, $deprecatedIn, $alternative, $lines, $okVersion, $deprecatedVersion = null)
    {
        $file = $this->sniffFile(__FILE__, $okVersion);
        foreach ($lines as $line) {
            $this->assertNoViolation($file, $line);
        }

        $errorVersion = (isset($deprecatedVersion)) ? $deprecatedVersion : $deprecatedIn;
        $file         = $this->sniffFile(__FILE__, $errorVersion);
        $error        = "Function {$functionName}() is deprecated since PHP {$deprecatedIn}; Use {$alternative} instead";
        foreach ($lines as $line) {
            $this->assertWarning($file, $line, $error);
        }
    }

    /**
     * Data provider.
     *
     * @see testDeprecatedFunctionWithAlternative()
     *
     * @return array
     */
    public function dataDeprecatedFunctionWithAlternative()
    {
        return array(
            array('ocibindbyname', '5.4', 'oci_bind_by_name()', array(41), '5.3'),
            array('ocicancel', '5.4', 'oci_cancel()', array(42), '5.3'),
            array('ocicloselob', '5.4', 'OCI-Lob::close()', array(43), '5.3'),
            array('ocicollappend', '5.4', 'OCI-Collection::append()', array(44), '5.3'),
            array('ocicollassign', '5.4', 'OCI-Collection::assign()', array(45), '5.3'),
            array('ocicollassignelem', '5.4', 'OCI-Collection::assignElem()', array(46), '5.3'),
            array('ocicollgetelem', '5.4', 'OCI-Collection::getElem()', array(47), '5.3'),
            array('ocicollmax', '5.4', 'OCI-Collection::max()', array(48), '5.3'),
            array('ocicollsize', '5.4', 'OCI-Collection::size()', array(49), '5.3'),
            array('ocicolltrim', '5.4', 'OCI-Collection::trim()', array(50), '5.3'),
            array('ocicolumnisnull', '5.4', 'oci_field_is_null()', array(51), '5.3'),
            array('ocicolumnname', '5.4', 'oci_field_name()', array(52), '5.3'),
            array('ocicolumnprecision', '5.4', 'oci_field_precision()', array(53), '5.3'),
            array('ocicolumnscale', '5.4', 'oci_field_scale()', array(54), '5.3'),
            array('ocicolumnsize', '5.4', 'oci_field_size()', array(55), '5.3'),
            array('ocicolumntype', '5.4', 'oci_field_type()', array(56), '5.3'),
            array('ocicolumntyperaw', '5.4', 'oci_field_type_raw()', array(57), '5.3'),
            array('ocicommit', '5.4', 'oci_commit()', array(58), '5.3'),
            array('ocidefinebyname', '5.4', 'oci_define_by_name()', array(59), '5.3'),
            array('ocierror', '5.4', 'oci_error()', array(60), '5.3'),
            array('ociexecute', '5.4', 'oci_execute()', array(61), '5.3'),
            array('ocifetch', '5.4', 'oci_fetch()', array(62), '5.3'),
            array('ocifetchstatement', '5.4', 'oci_fetch_all()', array(64), '5.3'),
            array('ocifreecollection', '5.4', 'OCI-Collection::free()', array(65), '5.3'),
            array('ocifreecursor', '5.4', 'oci_free_statement()', array(66), '5.3'),
            array('ocifreedesc', '5.4', 'OCI-Lob::free()', array(67), '5.3'),
            array('ocifreestatement', '5.4', 'oci_free_statement()', array(68), '5.3'),
            array('ociinternaldebug', '5.4', 'oci_internal_debug()', array(69), '5.3'),
            array('ociloadlob', '5.4', 'OCI-Lob::load()', array(70), '5.3'),
            array('ocilogoff', '5.4', 'oci_close()', array(71), '5.3'),
            array('ocilogon', '5.4', 'oci_connect()', array(72), '5.3'),
            array('ocinewcollection', '5.4', 'oci_new_collection()', array(73), '5.3'),
            array('ocinewcursor', '5.4', 'oci_new_cursor()', array(74), '5.3'),
            array('ocinewdescriptor', '5.4', 'oci_new_descriptor()', array(75), '5.3'),
            array('ocinlogon', '5.4', 'oci_new_connect()', array(76), '5.3'),
            array('ocinumcols', '5.4', 'oci_num_fields()', array(77), '5.3'),
            array('ociparse', '5.4', 'oci_parse()', array(78), '5.3'),
            array('ociplogon', '5.4', 'oci_pconnect()', array(79), '5.3'),
            array('ociresult', '5.4', 'oci_result()', array(80), '5.3'),
            array('ocirollback', '5.4', 'oci_rollback()', array(81), '5.3'),
            array('ocirowcount', '5.4', 'oci_num_rows()', array(82), '5.3'),
            array('ocisavelob', '5.4', 'OCI-Lob::save()', array(83), '5.3'),
            array('ocisavelobfile', '5.4', 'OCI-Lob::import()', array(84), '5.3'),
            array('ociserverversion', '5.4', 'oci_server_version()', array(85), '5.3'),
            array('ocisetprefetch', '5.4', 'oci_set_prefetch()', array(86), '5.3'),
            array('ocistatementtype', '5.4', 'oci_statement_type()', array(87), '5.3'),
            array('ociwritelobtofile', '5.4', 'OCI-Lob::export()', array(88), '5.3'),
            array('ociwritetemporarylob', '5.4', 'OCI-Lob::writeTemporary()', array(89), '5.3'),

            array('jpeg2wbmp', '7.2', 'imagecreatefromjpeg() and imagewbmp()', array(144), '7.1'),
            array('png2wbmp', '7.2', 'imagecreatefrompng() or imagewbmp()', array(145), '7.1'),
            array('create_function', '7.2', 'an anonymous function', array(146), '7.1'),
            array('__autoload', '7.2', 'SPL autoload', array(589), '7.1'),
            array('each', '7.2', 'a foreach loop', array(147), '7.1'),
            array('gmp_random', '7.2', 'gmp_random_bits() or gmp_random_range()', array(148), '7.1'),
            array('read_exif_data', '7.2', 'exif_read_data()', array(149), '7.1'),

            array('image2wbmp', '7.3', 'imagewbmp()', array(152), '7.2'),
            array('mbregex_encoding', '7.3', 'mb_regex_encoding()', array(153), '7.2'),
            array('mbereg', '7.3', 'mb_ereg()', array(154), '7.2'),
            array('mberegi', '7.3', 'mb_eregi()', array(155), '7.2'),
            array('mbereg_replace', '7.3', 'mb_ereg_replace()', array(156), '7.2'),
            array('mberegi_replace', '7.3', 'mb_eregi_replace()', array(157), '7.2'),
            array('mbsplit', '7.3', 'mb_split()', array(158), '7.2'),
            array('mbereg_match', '7.3', 'mb_ereg_match()', array(159), '7.2'),
            array('mbereg_search', '7.3', 'mb_ereg_search()', array(160), '7.2'),
            array('mbereg_search_pos', '7.3', 'mb_ereg_search_pos()', array(161), '7.2'),
            array('mbereg_search_regs', '7.3', 'mb_ereg_search_regs()', array(162), '7.2'),
            array('mbereg_search_init', '7.3', 'mb_ereg_search_init()', array(163), '7.2'),
            array('mbereg_search_getregs', '7.3', 'mb_ereg_search_getregs()', array(164), '7.2'),
            array('mbereg_search_getpos', '7.3', 'mb_ereg_search_getpos()', array(165), '7.2'),
            array('mbereg_search_setpos', '7.3', 'mb_ereg_search_setpos()', array(166), '7.2'),

            array('convert_cyr_string', '7.4', 'mb_convert_encoding(), iconv() or UConverter', array(243), '7.3'),
            array('is_real', '7.4', 'is_float()', array(239), '7.3'),
            array('money_format', '7.4', 'NumberFormatter::formatCurrency()', array(244), '7.3'),
            array('restore_include_path', '7.4', "ini_restore('include_path')", array(246), '7.3'),
            array('ldap_control_paged_result', '7.4', 'ldap_search()', array(235), '7.3'),
            array('ldap_control_paged_result', '7.4', 'ldap_search()', array(235), '7.3'),
        );
    }


    /**
     * testRemovedFunction
     *
     * @dataProvider dataRemovedFunction
     *
     * @param string $functionName   Name of the function.
     * @param string $removedIn      The PHP version in which the function was removed.
     * @param array  $lines          The line numbers in the test file which apply to this function.
     * @param string $okVersion      A PHP version in which the function was still valid.
     * @param string $removedVersion Optional PHP version to test removed message with -
     *                               if different from the $removedIn version.
     *
     * @return void
     */
    public function testRemovedFunction($functionName, $removedIn, $lines, $okVersion, $removedVersion = null)
    {
        $file = $this->sniffFile(__FILE__, $okVersion);
        foreach ($lines as $line) {
            $this->assertNoViolation($file, $line);
        }

        $errorVersion = (isset($removedVersion)) ? $removedVersion : $removedIn;
        $file         = $this->sniffFile(__FILE__, $errorVersion);
        $error        = "Function {$functionName}() is removed since PHP {$removedIn}";
        foreach ($lines as $line) {
            $this->assertError($file, $line, $error);
        }
    }

    /**
     * Data provider.
     *
     * @see testRemovedFunction()
     *
     * @return array
     */
    public function dataRemovedFunction()
    {
        return array(
            array('crack_check', '5.0', array(592), '4.4'),
            array('crack_closedict', '5.0', array(593), '4.4'),
            array('crack_getlastmessage', '5.0', array(594), '4.4'),
            array('crack_opendict', '5.0', array(595), '4.4'),

            array('pfpro_cleanup', '5.1', array(221), '5.0'),
            array('pfpro_init', '5.1', array(222), '5.0'),
            array('pfpro_process_raw', '5.1', array(223), '5.0'),
            array('pfpro_process', '5.1', array(224), '5.0'),
            array('pfpro_version', '5.1', array(225), '5.0'),
            array('m_checkstatus', '5.1', array(417), '5.0'),
            array('m_completeauthorizations', '5.1', array(418), '5.0'),
            array('m_connect', '5.1', array(419), '5.0'),
            array('m_connectionerror', '5.1', array(420), '5.0'),
            array('m_deletetrans', '5.1', array(421), '5.0'),
            array('m_destroyconn', '5.1', array(422), '5.0'),
            array('m_destroyengine', '5.1', array(423), '5.0'),
            array('m_getcell', '5.1', array(424), '5.0'),
            array('m_getcellbynum', '5.1', array(425), '5.0'),
            array('m_getcommadelimited', '5.1', array(426), '5.0'),
            array('m_getheader', '5.1', array(427), '5.0'),
            array('m_initconn', '5.1', array(428), '5.0'),
            array('m_initengine', '5.1', array(429), '5.0'),
            array('m_iscommadelimited', '5.1', array(430), '5.0'),
            array('m_maxconntimeout', '5.1', array(431), '5.0'),
            array('m_monitor', '5.1', array(432), '5.0'),
            array('m_numcolumns', '5.1', array(433), '5.0'),
            array('m_numrows', '5.1', array(434), '5.0'),
            array('m_parsecommadelimited', '5.1', array(435), '5.0'),
            array('m_responsekeys', '5.1', array(436), '5.0'),
            array('m_responseparam', '5.1', array(437), '5.0'),
            array('m_returnstatus', '5.1', array(438), '5.0'),
            array('m_setblocking', '5.1', array(439), '5.0'),
            array('m_setdropfile', '5.1', array(440), '5.0'),
            array('m_setip', '5.1', array(441), '5.0'),
            array('m_setssl_cafile', '5.1', array(442), '5.0'),
            array('m_setssl_files', '5.1', array(443), '5.0'),
            array('m_setssl', '5.1', array(444), '5.0'),
            array('m_settimeout', '5.1', array(445), '5.0'),
            array('m_sslcert_gen_hash', '5.1', array(446), '5.0'),
            array('m_transactionssent', '5.1', array(447), '5.0'),
            array('m_transinqueue', '5.1', array(448), '5.0'),
            array('m_transkeyval', '5.1', array(449), '5.0'),
            array('m_transnew', '5.1', array(450), '5.0'),
            array('m_transsend', '5.1', array(451), '5.0'),
            array('m_uwait', '5.1', array(452), '5.0'),
            array('m_validateidentifier', '5.1', array(453), '5.0'),
            array('m_verifyconnection', '5.1', array(454), '5.0'),
            array('m_verifysslcert', '5.1', array(455), '5.0'),
            array('dio_close', '5.1', array(458), '5.0'),
            array('dio_fcntl', '5.1', array(459), '5.0'),
            array('dio_open', '5.1', array(460), '5.0'),
            array('dio_read', '5.1', array(461), '5.0'),
            array('dio_seek', '5.1', array(462), '5.0'),
            array('dio_stat', '5.1', array(463), '5.0'),
            array('dio_tcsetattr', '5.1', array(464), '5.0'),
            array('dio_truncate', '5.1', array(465), '5.0'),
            array('dio_write', '5.1', array(466), '5.0'),
            array('fam_cancel_monitor', '5.1', array(514), '5.0'),
            array('fam_close', '5.1', array(515), '5.0'),
            array('fam_monitor_collection', '5.1', array(516), '5.0'),
            array('fam_monitor_directory', '5.1', array(517), '5.0'),
            array('fam_monitor_file', '5.1', array(518), '5.0'),
            array('fam_next_event', '5.1', array(519), '5.0'),
            array('fam_open', '5.1', array(520), '5.0'),
            array('fam_pending', '5.1', array(521), '5.0'),
            array('fam_resume_monitor', '5.1', array(522), '5.0'),
            array('fam_suspend_monitor', '5.1', array(523), '5.0'),
            array('yp_all', '5.1', array(532), '5.0'),
            array('yp_cat', '5.1', array(533), '5.0'),
            array('yp_err_string', '5.1', array(534), '5.0'),
            array('yp_errno', '5.1', array(535), '5.0'),
            array('yp_first', '5.1', array(536), '5.0'),
            array('yp_get_default_domain', '5.1', array(537), '5.0'),
            array('yp_master', '5.1', array(538), '5.0'),
            array('yp_match', '5.1', array(539), '5.0'),
            array('yp_next', '5.1', array(540), '5.0'),
            array('yp_order', '5.1', array(541), '5.0'),
            array('udm_add_search_limit', '5.1', array(544), '5.0'),
            array('udm_alloc_agent_array', '5.1', array(545), '5.0'),
            array('udm_alloc_agent', '5.1', array(546), '5.0'),
            array('udm_api_version', '5.1', array(547), '5.0'),
            array('udm_cat_list', '5.1', array(548), '5.0'),
            array('udm_cat_path', '5.1', array(549), '5.0'),
            array('udm_check_charset', '5.1', array(550), '5.0'),
            array('udm_clear_search_limits', '5.1', array(551), '5.0'),
            array('udm_crc32', '5.1', array(552), '5.0'),
            array('udm_errno', '5.1', array(553), '5.0'),
            array('udm_error', '5.1', array(554), '5.0'),
            array('udm_find', '5.1', array(555), '5.0'),
            array('udm_free_agent', '5.1', array(556), '5.0'),
            array('udm_free_ispell_data', '5.1', array(557), '5.0'),
            array('udm_free_res', '5.1', array(558), '5.0'),
            array('udm_get_doc_count', '5.1', array(559), '5.0'),
            array('udm_get_res_field', '5.1', array(560), '5.0'),
            array('udm_get_res_param', '5.1', array(561), '5.0'),
            array('udm_hash32', '5.1', array(562), '5.0'),
            array('udm_load_ispell_data', '5.1', array(563), '5.0'),
            array('udm_set_agent_param', '5.1', array(564), '5.0'),
            array('w32api_deftype', '5.1', array(598), '5.0'),
            array('w32api_init_dtype', '5.1', array(599), '5.0'),
            array('w32api_invoke_function', '5.1', array(600), '5.0'),
            array('w32api_register_function', '5.1', array(601), '5.0'),
            array('w32api_set_call_method', '5.1', array(602), '5.0'),
            array('cpdf_add_annotation', '5.1', array(605), '5.0'),
            array('cpdf_add_outline', '5.1', array(606), '5.0'),
            array('cpdf_arc', '5.1', array(607), '5.0'),
            array('cpdf_begin_text', '5.1', array(608), '5.0'),
            array('cpdf_circle', '5.1', array(609), '5.0'),
            array('cpdf_clip', '5.1', array(610), '5.0'),
            array('cpdf_close', '5.1', array(611), '5.0'),
            array('cpdf_closepath_fill_stroke', '5.1', array(612), '5.0'),
            array('cpdf_closepath_stroke', '5.1', array(613), '5.0'),
            array('cpdf_closepath', '5.1', array(614), '5.0'),
            array('cpdf_continue_text', '5.1', array(615), '5.0'),
            array('cpdf_curveto', '5.1', array(616), '5.0'),
            array('cpdf_end_text', '5.1', array(617), '5.0'),
            array('cpdf_fill_stroke', '5.1', array(618), '5.0'),
            array('cpdf_fill', '5.1', array(619), '5.0'),
            array('cpdf_finalize_page', '5.1', array(620), '5.0'),
            array('cpdf_finalize', '5.1', array(621), '5.0'),
            array('cpdf_global_set_document_limits', '5.1', array(622), '5.0'),
            array('cpdf_import_jpeg', '5.1', array(623), '5.0'),
            array('cpdf_lineto', '5.1', array(624), '5.0'),
            array('cpdf_moveto', '5.1', array(625), '5.0'),
            array('cpdf_newpath', '5.1', array(626), '5.0'),
            array('cpdf_open', '5.1', array(627), '5.0'),
            array('cpdf_output_buffer', '5.1', array(628), '5.0'),
            array('cpdf_page_init', '5.1', array(629), '5.0'),
            array('cpdf_place_inline_image', '5.1', array(630), '5.0'),
            array('cpdf_rect', '5.1', array(631), '5.0'),
            array('cpdf_restore', '5.1', array(632), '5.0'),
            array('cpdf_rlineto', '5.1', array(633), '5.0'),
            array('cpdf_rmoveto', '5.1', array(634), '5.0'),
            array('cpdf_rotate_text', '5.1', array(635), '5.0'),
            array('cpdf_rotate', '5.1', array(636), '5.0'),
            array('cpdf_save_to_file', '5.1', array(637), '5.0'),
            array('cpdf_save', '5.1', array(638), '5.0'),
            array('cpdf_scale', '5.1', array(639), '5.0'),
            array('cpdf_set_action_url', '5.1', array(640), '5.0'),
            array('cpdf_set_char_spacing', '5.1', array(641), '5.0'),
            array('cpdf_set_creator', '5.1', array(642), '5.0'),
            array('cpdf_set_current_page', '5.1', array(643), '5.0'),
            array('cpdf_set_font_directories', '5.1', array(644), '5.0'),
            array('cpdf_set_font_map_file', '5.1', array(645), '5.0'),
            array('cpdf_set_font', '5.1', array(646), '5.0'),
            array('cpdf_set_horiz_scaling', '5.1', array(647), '5.0'),
            array('cpdf_set_keywords', '5.1', array(648), '5.0'),
            array('cpdf_set_leading', '5.1', array(649), '5.0'),
            array('cpdf_set_page_animation', '5.1', array(650), '5.0'),
            array('cpdf_set_subject', '5.1', array(651), '5.0'),
            array('cpdf_set_text_matrix', '5.1', array(652), '5.0'),
            array('cpdf_set_text_pos', '5.1', array(653), '5.0'),
            array('cpdf_set_text_rendering', '5.1', array(654), '5.0'),
            array('cpdf_set_text_rise', '5.1', array(655), '5.0'),
            array('cpdf_set_title', '5.1', array(656), '5.0'),
            array('cpdf_set_viewer_preferences', '5.1', array(657), '5.0'),
            array('cpdf_set_word_spacing', '5.1', array(658), '5.0'),
            array('cpdf_setdash', '5.1', array(659), '5.0'),
            array('cpdf_setflat', '5.1', array(660), '5.0'),
            array('cpdf_setgray_fill', '5.1', array(661), '5.0'),
            array('cpdf_setgray_stroke', '5.1', array(662), '5.0'),
            array('cpdf_setgray', '5.1', array(663), '5.0'),
            array('cpdf_setlinecap', '5.1', array(664), '5.0'),
            array('cpdf_setlinejoin', '5.1', array(665), '5.0'),
            array('cpdf_setlinewidth', '5.1', array(666), '5.0'),
            array('cpdf_setmiterlimit', '5.1', array(667), '5.0'),
            array('cpdf_setrgbcolor_fill', '5.1', array(668), '5.0'),
            array('cpdf_setrgbcolor_stroke', '5.1', array(669), '5.0'),
            array('cpdf_setrgbcolor', '5.1', array(670), '5.0'),
            array('cpdf_show_xy', '5.1', array(671), '5.0'),
            array('cpdf_show', '5.1', array(672), '5.0'),
            array('cpdf_stringwidth', '5.1', array(673), '5.0'),
            array('cpdf_stroke', '5.1', array(674), '5.0'),
            array('cpdf_text', '5.1', array(675), '5.0'),
            array('cpdf_translate', '5.1', array(676), '5.0'),
            array('ircg_channel_mode', '5.1', array(677), '5.0'),
            array('ircg_disconnect', '5.1', array(678), '5.0'),
            array('ircg_eval_ecmascript_params', '5.1', array(679), '5.0'),
            array('ircg_fetch_error_msg', '5.1', array(680), '5.0'),
            array('ircg_get_username', '5.1', array(681), '5.0'),
            array('ircg_html_encode', '5.1', array(682), '5.0'),
            array('ircg_ignore_add', '5.1', array(683), '5.0'),
            array('ircg_ignore_del', '5.1', array(684), '5.0'),
            array('ircg_invite', '5.1', array(685), '5.0'),
            array('ircg_is_conn_alive', '5.1', array(686), '5.0'),
            array('ircg_join', '5.1', array(687), '5.0'),
            array('ircg_kick', '5.1', array(688), '5.0'),
            array('ircg_list', '5.1', array(689), '5.0'),
            array('ircg_lookup_format_messages', '5.1', array(690), '5.0'),
            array('ircg_lusers', '5.1', array(691), '5.0'),
            array('ircg_msg', '5.1', array(692), '5.0'),
            array('ircg_names', '5.1', array(693), '5.0'),
            array('ircg_nick', '5.1', array(694), '5.0'),
            array('ircg_nickname_escape', '5.1', array(695), '5.0'),
            array('ircg_nickname_unescape', '5.1', array(696), '5.0'),
            array('ircg_notice', '5.1', array(697), '5.0'),
            array('ircg_oper', '5.1', array(698), '5.0'),
            array('ircg_part', '5.1', array(699), '5.0'),
            array('ircg_pconnect', '5.1', array(700), '5.0'),
            array('ircg_register_format_messages', '5.1', array(701), '5.0'),
            array('ircg_set_current', '5.1', array(702), '5.0'),
            array('ircg_set_file', '5.1', array(703), '5.0'),
            array('ircg_set_on_die', '5.1', array(704), '5.0'),
            array('ircg_topic', '5.1', array(705), '5.0'),
            array('ircg_who', '5.1', array(706), '5.0'),
            array('ircg_whois', '5.1', array(707), '5.0'),
            array('dbx_close', '5.1', array(720), '5.0'),
            array('dbx_compare', '5.1', array(721), '5.0'),
            array('dbx_connect', '5.1', array(722), '5.0'),
            array('dbx_error', '5.1', array(723), '5.0'),
            array('dbx_escape_string', '5.1', array(724), '5.0'),
            array('dbx_fetch_row', '5.1', array(725), '5.0'),
            array('dbx_query', '5.1', array(726), '5.0'),
            array('dbx_sort', '5.1', array(727), '5.0'),
            array('ingres_autocommit', '5.1', array(795), '5.0'),
            array('ingres_close', '5.1', array(796), '5.0'),
            array('ingres_commit', '5.1', array(797), '5.0'),
            array('ingres_connect', '5.1', array(798), '5.0'),
            array('ingres_fetch_array', '5.1', array(799), '5.0'),
            array('ingres_fetch_object', '5.1', array(800), '5.0'),
            array('ingres_fetch_row', '5.1', array(801), '5.0'),
            array('ingres_field_length', '5.1', array(802), '5.0'),
            array('ingres_field_name', '5.1', array(803), '5.0'),
            array('ingres_field_nullable', '5.1', array(804), '5.0'),
            array('ingres_field_precision', '5.1', array(805), '5.0'),
            array('ingres_field_scale', '5.1', array(806), '5.0'),
            array('ingres_field_type', '5.1', array(807), '5.0'),
            array('ingres_num_fields', '5.1', array(808), '5.0'),
            array('ingres_num_rows', '5.1', array(809), '5.0'),
            array('ingres_pconnect', '5.1', array(810), '5.0'),
            array('ingres_query', '5.1', array(811), '5.0'),
            array('ingres_rollback', '5.1', array(812), '5.0'),
            array('ovrimos_close', '5.1', array(1036), '5.0'),
            array('ovrimos_commit', '5.1', array(1037), '5.0'),
            array('ovrimos_connect', '5.1', array(1038), '5.0'),
            array('ovrimos_cursor', '5.1', array(1039), '5.0'),
            array('ovrimos_exec', '5.1', array(1040), '5.0'),
            array('ovrimos_execute', '5.1', array(1041), '5.0'),
            array('ovrimos_fetch_into', '5.1', array(1042), '5.0'),
            array('ovrimos_fetch_row', '5.1', array(1043), '5.0'),
            array('ovrimos_field_len', '5.1', array(1044), '5.0'),
            array('ovrimos_field_name', '5.1', array(1045), '5.0'),
            array('ovrimos_field_num', '5.1', array(1046), '5.0'),
            array('ovrimos_field_type', '5.1', array(1047), '5.0'),
            array('ovrimos_free_result', '5.1', array(1048), '5.0'),
            array('ovrimos_longreadlen', '5.1', array(1049), '5.0'),
            array('ovrimos_num_fields', '5.1', array(1050), '5.0'),
            array('ovrimos_num_rows', '5.1', array(1051), '5.0'),
            array('ovrimos_prepare', '5.1', array(1052), '5.0'),
            array('ovrimos_result_all', '5.1', array(1053), '5.0'),
            array('ovrimos_result', '5.1', array(1054), '5.0'),
            array('ovrimos_rollback', '5.1', array(1055), '5.0'),
            array('ovrimos_close_all', '5.1', array(1056), '5.0'),
            array('ora_bind', '5.1', array(1058), '5.0'),
            array('ora_close', '5.1', array(1059), '5.0'),
            array('ora_columnname', '5.1', array(1060), '5.0'),
            array('ora_columnsize', '5.1', array(1061), '5.0'),
            array('ora_columntype', '5.1', array(1062), '5.0'),
            array('ora_commit', '5.1', array(1063), '5.0'),
            array('ora_commitoff', '5.1', array(1064), '5.0'),
            array('ora_commiton', '5.1', array(1065), '5.0'),
            array('ora_do', '5.1', array(1066), '5.0'),
            array('ora_error', '5.1', array(1067), '5.0'),
            array('ora_errorcode', '5.1', array(1068), '5.0'),
            array('ora_exec', '5.1', array(1069), '5.0'),
            array('ora_fetch_into', '5.1', array(1070), '5.0'),
            array('ora_fetch', '5.1', array(1071), '5.0'),
            array('ora_getcolumn', '5.1', array(1072), '5.0'),
            array('ora_logoff', '5.1', array(1073), '5.0'),
            array('ora_logon', '5.1', array(1074), '5.0'),
            array('ora_numcols', '5.1', array(1075), '5.0'),
            array('ora_numrows', '5.1', array(1076), '5.0'),
            array('ora_open', '5.1', array(1077), '5.0'),
            array('ora_parse', '5.1', array(1078), '5.0'),
            array('ora_plogon', '5.1', array(1079), '5.0'),
            array('ora_rollback', '5.1', array(1080), '5.0'),
            array('mysqli_embedded_connect', '5.1', array(1146), '5.0'),
            array('mysqli_server_end', '5.1', array(1155), '5.0'),
            array('mysqli_server_init', '5.1', array(1156), '5.0'),

            array('msession_connect', '5.1.3', array(567), '5.1', '5.2'),
            array('msession_count', '5.1.3', array(568), '5.1', '5.2'),
            array('msession_create', '5.1.3', array(569), '5.1', '5.2'),
            array('msession_destroy', '5.1.3', array(570), '5.1', '5.2'),
            array('msession_disconnect', '5.1.3', array(571), '5.1', '5.2'),
            array('msession_find', '5.1.3', array(572), '5.1', '5.2'),
            array('msession_get_array', '5.1.3', array(573), '5.1', '5.2'),
            array('msession_get_data', '5.1.3', array(574), '5.1', '5.2'),
            array('msession_get', '5.1.3', array(575), '5.1', '5.2'),
            array('msession_inc', '5.1.3', array(576), '5.1', '5.2'),
            array('msession_list', '5.1.3', array(577), '5.1', '5.2'),
            array('msession_listvar', '5.1.3', array(578), '5.1', '5.2'),
            array('msession_lock', '5.1.3', array(579), '5.1', '5.2'),
            array('msession_plugin', '5.1.3', array(580), '5.1', '5.2'),
            array('msession_randstr', '5.1.3', array(581), '5.1', '5.2'),
            array('msession_set_array', '5.1.3', array(582), '5.1', '5.2'),
            array('msession_set_data', '5.1.3', array(583), '5.1', '5.2'),
            array('msession_set', '5.1.3', array(584), '5.1', '5.2'),
            array('msession_timeout', '5.1.3', array(585), '5.1', '5.2'),
            array('msession_uniq', '5.1.3', array(586), '5.1', '5.2'),
            array('msession_unlock', '5.1.3', array(587), '5.1', '5.2'),

            array('mysqli_resource', '5.1.4', array(1152), '5.1', '5.2'),

            array('mysql_createdb', '5.1.7', array(975), '5.1', '5.2'),
            array('mysql_dropdb', '5.1.7', array(976), '5.1', '5.2'),
            array('mysql_listtables', '5.1.7', array(981), '5.1', '5.2'),

            array('hwapi_attribute_new', '5.2', array(526), '5.1'),
            array('hwapi_content_new', '5.2', array(527), '5.1'),
            array('hwapi_hgcsp', '5.2', array(528), '5.1'),
            array('hwapi_object_new', '5.2', array(529), '5.1'),
            array('filepro_fieldcount', '5.2', array(788), '5.1'),
            array('filepro_fieldname', '5.2', array(789), '5.1'),
            array('filepro_fieldtype', '5.2', array(790), '5.1'),
            array('filepro_fieldwidth', '5.2', array(791), '5.1'),
            array('filepro_retrieve', '5.2', array(792), '5.1'),
            array('filepro_rowcount', '5.2', array(793), '5.1'),
            array('filepro', '5.2', array(794), '5.1'),

            array('ifx_affected_rows', '5.2.1', array(1106), '5.2', '5.3'),
            array('ifx_blobinfile_mode', '5.2.1', array(1107), '5.2', '5.3'),
            array('ifx_byteasvarchar', '5.2.1', array(1108), '5.2', '5.3'),
            array('ifx_close', '5.2.1', array(1109), '5.2', '5.3'),
            array('ifx_connect', '5.2.1', array(1110), '5.2', '5.3'),
            array('ifx_copy_blob', '5.2.1', array(1111), '5.2', '5.3'),
            array('ifx_create_blob', '5.2.1', array(1112), '5.2', '5.3'),
            array('ifx_create_char', '5.2.1', array(1113), '5.2', '5.3'),
            array('ifx_do', '5.2.1', array(1114), '5.2', '5.3'),
            array('ifx_error', '5.2.1', array(1115), '5.2', '5.3'),
            array('ifx_errormsg', '5.2.1', array(1116), '5.2', '5.3'),
            array('ifx_fetch_row', '5.2.1', array(1117), '5.2', '5.3'),
            array('ifx_fieldproperties', '5.2.1', array(1118), '5.2', '5.3'),
            array('ifx_fieldtypes', '5.2.1', array(1119), '5.2', '5.3'),
            array('ifx_free_blob', '5.2.1', array(1120), '5.2', '5.3'),
            array('ifx_free_char', '5.2.1', array(1121), '5.2', '5.3'),
            array('ifx_free_result', '5.2.1', array(1122), '5.2', '5.3'),
            array('ifx_get_blob', '5.2.1', array(1123), '5.2', '5.3'),
            array('ifx_get_char', '5.2.1', array(1124), '5.2', '5.3'),
            array('ifx_getsqlca', '5.2.1', array(1125), '5.2', '5.3'),
            array('ifx_htmltbl_result', '5.2.1', array(1126), '5.2', '5.3'),
            array('ifx_nullformat', '5.2.1', array(1127), '5.2', '5.3'),
            array('ifx_num_fields', '5.2.1', array(1128), '5.2', '5.3'),
            array('ifx_num_rows', '5.2.1', array(1129), '5.2', '5.3'),
            array('ifx_pconnect', '5.2.1', array(1130), '5.2', '5.3'),
            array('ifx_prepare', '5.2.1', array(1131), '5.2', '5.3'),
            array('ifx_query', '5.2.1', array(1132), '5.2', '5.3'),
            array('ifx_textasvarchar', '5.2.1', array(1133), '5.2', '5.3'),
            array('ifx_update_blob', '5.2.1', array(1134), '5.2', '5.3'),
            array('ifx_update_char', '5.2.1', array(1135), '5.2', '5.3'),
            array('ifxus_close_slob', '5.2.1', array(1136), '5.2', '5.3'),
            array('ifxus_create_slob', '5.2.1', array(1137), '5.2', '5.3'),
            array('ifxus_free_slob', '5.2.1', array(1138), '5.2', '5.3'),
            array('ifxus_open_slob', '5.2.1', array(1139), '5.2', '5.3'),
            array('ifxus_read_slob', '5.2.1', array(1140), '5.2', '5.3'),
            array('ifxus_seek_slob', '5.2.1', array(1141), '5.2', '5.3'),
            array('ifxus_tell_slob', '5.2.1', array(1142), '5.2', '5.3'),
            array('ifxus_write_slob', '5.2.1', array(1143), '5.2', '5.3'),

            array('ncurses_addch', '5.3', array(255), '5.2'),
            array('ncurses_addchnstr', '5.3', array(256), '5.2'),
            array('ncurses_addchstr', '5.3', array(257), '5.2'),
            array('ncurses_addnstr', '5.3', array(258), '5.2'),
            array('ncurses_addstr', '5.3', array(259), '5.2'),
            array('ncurses_assume_default_colors', '5.3', array(260), '5.2'),
            array('ncurses_attroff', '5.3', array(261), '5.2'),
            array('ncurses_attron', '5.3', array(262), '5.2'),
            array('ncurses_attrset', '5.3', array(263), '5.2'),
            array('ncurses_baudrate', '5.3', array(264), '5.2'),
            array('ncurses_beep', '5.3', array(265), '5.2'),
            array('ncurses_bkgd', '5.3', array(266), '5.2'),
            array('ncurses_bkgdset', '5.3', array(267), '5.2'),
            array('ncurses_border', '5.3', array(268), '5.2'),
            array('ncurses_bottom_panel', '5.3', array(269), '5.2'),
            array('ncurses_can_change_color', '5.3', array(270), '5.2'),
            array('ncurses_cbreak', '5.3', array(271), '5.2'),
            array('ncurses_clear', '5.3', array(272), '5.2'),
            array('ncurses_clrtobot', '5.3', array(273), '5.2'),
            array('ncurses_clrtoeol', '5.3', array(274), '5.2'),
            array('ncurses_color_content', '5.3', array(275), '5.2'),
            array('ncurses_color_set', '5.3', array(276), '5.2'),
            array('ncurses_curs_set', '5.3', array(277), '5.2'),
            array('ncurses_def_prog_mode', '5.3', array(278), '5.2'),
            array('ncurses_def_shell_mode', '5.3', array(279), '5.2'),
            array('ncurses_define_key', '5.3', array(280), '5.2'),
            array('ncurses_del_panel', '5.3', array(281), '5.2'),
            array('ncurses_delay_output', '5.3', array(282), '5.2'),
            array('ncurses_delch', '5.3', array(283), '5.2'),
            array('ncurses_deleteln', '5.3', array(284), '5.2'),
            array('ncurses_delwin', '5.3', array(285), '5.2'),
            array('ncurses_doupdate', '5.3', array(286), '5.2'),
            array('ncurses_echo', '5.3', array(287), '5.2'),
            array('ncurses_echochar', '5.3', array(288), '5.2'),
            array('ncurses_end', '5.3', array(289), '5.2'),
            array('ncurses_erase', '5.3', array(290), '5.2'),
            array('ncurses_erasechar', '5.3', array(291), '5.2'),
            array('ncurses_filter', '5.3', array(292), '5.2'),
            array('ncurses_flash', '5.3', array(293), '5.2'),
            array('ncurses_flushinp', '5.3', array(294), '5.2'),
            array('ncurses_getch', '5.3', array(295), '5.2'),
            array('ncurses_getmaxyx', '5.3', array(296), '5.2'),
            array('ncurses_getmouse', '5.3', array(297), '5.2'),
            array('ncurses_getyx', '5.3', array(298), '5.2'),
            array('ncurses_halfdelay', '5.3', array(299), '5.2'),
            array('ncurses_has_colors', '5.3', array(300), '5.2'),
            array('ncurses_has_ic', '5.3', array(301), '5.2'),
            array('ncurses_has_il', '5.3', array(302), '5.2'),
            array('ncurses_has_key', '5.3', array(303), '5.2'),
            array('ncurses_hide_panel', '5.3', array(304), '5.2'),
            array('ncurses_hline', '5.3', array(305), '5.2'),
            array('ncurses_inch', '5.3', array(306), '5.2'),
            array('ncurses_init_color', '5.3', array(307), '5.2'),
            array('ncurses_init_pair', '5.3', array(308), '5.2'),
            array('ncurses_init', '5.3', array(309), '5.2'),
            array('ncurses_insch', '5.3', array(310), '5.2'),
            array('ncurses_insdelln', '5.3', array(311), '5.2'),
            array('ncurses_insertln', '5.3', array(312), '5.2'),
            array('ncurses_insstr', '5.3', array(313), '5.2'),
            array('ncurses_instr', '5.3', array(314), '5.2'),
            array('ncurses_isendwin', '5.3', array(315), '5.2'),
            array('ncurses_keyok', '5.3', array(316), '5.2'),
            array('ncurses_keypad', '5.3', array(317), '5.2'),
            array('ncurses_killchar', '5.3', array(318), '5.2'),
            array('ncurses_longname', '5.3', array(319), '5.2'),
            array('ncurses_meta', '5.3', array(320), '5.2'),
            array('ncurses_mouse_trafo', '5.3', array(321), '5.2'),
            array('ncurses_mouseinterval', '5.3', array(322), '5.2'),
            array('ncurses_mousemask', '5.3', array(323), '5.2'),
            array('ncurses_move_panel', '5.3', array(324), '5.2'),
            array('ncurses_move', '5.3', array(325), '5.2'),
            array('ncurses_mvaddch', '5.3', array(326), '5.2'),
            array('ncurses_mvaddchnstr', '5.3', array(327), '5.2'),
            array('ncurses_mvaddchstr', '5.3', array(328), '5.2'),
            array('ncurses_mvaddnstr', '5.3', array(329), '5.2'),
            array('ncurses_mvaddstr', '5.3', array(330), '5.2'),
            array('ncurses_mvcur', '5.3', array(331), '5.2'),
            array('ncurses_mvdelch', '5.3', array(332), '5.2'),
            array('ncurses_mvgetch', '5.3', array(333), '5.2'),
            array('ncurses_mvhline', '5.3', array(334), '5.2'),
            array('ncurses_mvinch', '5.3', array(335), '5.2'),
            array('ncurses_mvvline', '5.3', array(336), '5.2'),
            array('ncurses_mvwaddstr', '5.3', array(337), '5.2'),
            array('ncurses_napms', '5.3', array(338), '5.2'),
            array('ncurses_new_panel', '5.3', array(339), '5.2'),
            array('ncurses_newpad', '5.3', array(340), '5.2'),
            array('ncurses_newwin', '5.3', array(341), '5.2'),
            array('ncurses_nl', '5.3', array(342), '5.2'),
            array('ncurses_nocbreak', '5.3', array(343), '5.2'),
            array('ncurses_noecho', '5.3', array(344), '5.2'),
            array('ncurses_nonl', '5.3', array(345), '5.2'),
            array('ncurses_noqiflush', '5.3', array(346), '5.2'),
            array('ncurses_noraw', '5.3', array(347), '5.2'),
            array('ncurses_pair_content', '5.3', array(348), '5.2'),
            array('ncurses_panel_above', '5.3', array(349), '5.2'),
            array('ncurses_panel_below', '5.3', array(350), '5.2'),
            array('ncurses_panel_window', '5.3', array(351), '5.2'),
            array('ncurses_pnoutrefresh', '5.3', array(352), '5.2'),
            array('ncurses_prefresh', '5.3', array(353), '5.2'),
            array('ncurses_putp', '5.3', array(354), '5.2'),
            array('ncurses_qiflush', '5.3', array(355), '5.2'),
            array('ncurses_raw', '5.3', array(356), '5.2'),
            array('ncurses_refresh', '5.3', array(357), '5.2'),
            array('ncurses_replace_panel', '5.3', array(358), '5.2'),
            array('ncurses_reset_prog_mode', '5.3', array(359), '5.2'),
            array('ncurses_reset_shell_mode', '5.3', array(360), '5.2'),
            array('ncurses_resetty', '5.3', array(361), '5.2'),
            array('ncurses_savetty', '5.3', array(362), '5.2'),
            array('ncurses_scr_dump', '5.3', array(363), '5.2'),
            array('ncurses_scr_init', '5.3', array(364), '5.2'),
            array('ncurses_scr_restore', '5.3', array(365), '5.2'),
            array('ncurses_scr_set', '5.3', array(366), '5.2'),
            array('ncurses_scrl', '5.3', array(367), '5.2'),
            array('ncurses_show_panel', '5.3', array(368), '5.2'),
            array('ncurses_slk_attr', '5.3', array(369), '5.2'),
            array('ncurses_slk_attroff', '5.3', array(370), '5.2'),
            array('ncurses_slk_attron', '5.3', array(371), '5.2'),
            array('ncurses_slk_attrset', '5.3', array(372), '5.2'),
            array('ncurses_slk_clear', '5.3', array(373), '5.2'),
            array('ncurses_slk_color', '5.3', array(374), '5.2'),
            array('ncurses_slk_init', '5.3', array(375), '5.2'),
            array('ncurses_slk_noutrefresh', '5.3', array(376), '5.2'),
            array('ncurses_slk_refresh', '5.3', array(377), '5.2'),
            array('ncurses_slk_restore', '5.3', array(378), '5.2'),
            array('ncurses_slk_set', '5.3', array(379), '5.2'),
            array('ncurses_slk_touch', '5.3', array(380), '5.2'),
            array('ncurses_standend', '5.3', array(381), '5.2'),
            array('ncurses_standout', '5.3', array(382), '5.2'),
            array('ncurses_start_color', '5.3', array(383), '5.2'),
            array('ncurses_termattrs', '5.3', array(384), '5.2'),
            array('ncurses_termname', '5.3', array(385), '5.2'),
            array('ncurses_timeout', '5.3', array(386), '5.2'),
            array('ncurses_top_panel', '5.3', array(387), '5.2'),
            array('ncurses_typeahead', '5.3', array(388), '5.2'),
            array('ncurses_ungetch', '5.3', array(389), '5.2'),
            array('ncurses_ungetmouse', '5.3', array(390), '5.2'),
            array('ncurses_update_panels', '5.3', array(391), '5.2'),
            array('ncurses_use_default_colors', '5.3', array(392), '5.2'),
            array('ncurses_use_env', '5.3', array(393), '5.2'),
            array('ncurses_use_extended_names', '5.3', array(394), '5.2'),
            array('ncurses_vidattr', '5.3', array(395), '5.2'),
            array('ncurses_vline', '5.3', array(396), '5.2'),
            array('ncurses_waddch', '5.3', array(397), '5.2'),
            array('ncurses_waddstr', '5.3', array(398), '5.2'),
            array('ncurses_wattroff', '5.3', array(399), '5.2'),
            array('ncurses_wattron', '5.3', array(400), '5.2'),
            array('ncurses_wattrset', '5.3', array(401), '5.2'),
            array('ncurses_wborder', '5.3', array(402), '5.2'),
            array('ncurses_wclear', '5.3', array(403), '5.2'),
            array('ncurses_wcolor_set', '5.3', array(404), '5.2'),
            array('ncurses_werase', '5.3', array(405), '5.2'),
            array('ncurses_wgetch', '5.3', array(406), '5.2'),
            array('ncurses_whline', '5.3', array(407), '5.2'),
            array('ncurses_wmouse_trafo', '5.3', array(408), '5.2'),
            array('ncurses_wmove', '5.3', array(409), '5.2'),
            array('ncurses_wnoutrefresh', '5.3', array(410), '5.2'),
            array('ncurses_wrefresh', '5.3', array(411), '5.2'),
            array('ncurses_wstandend', '5.3', array(412), '5.2'),
            array('ncurses_wstandout', '5.3', array(413), '5.2'),
            array('ncurses_wvline', '5.3', array(414), '5.2'),
            array('fdf_add_doc_javascript', '5.3', array(469), '5.2'),
            array('fdf_add_template', '5.3', array(470), '5.2'),
            array('fdf_close', '5.3', array(471), '5.2'),
            array('fdf_create', '5.3', array(472), '5.2'),
            array('fdf_enum_values', '5.3', array(473), '5.2'),
            array('fdf_errno', '5.3', array(474), '5.2'),
            array('fdf_error', '5.3', array(475), '5.2'),
            array('fdf_get_ap', '5.3', array(476), '5.2'),
            array('fdf_get_attachment', '5.3', array(477), '5.2'),
            array('fdf_get_encoding', '5.3', array(478), '5.2'),
            array('fdf_get_file', '5.3', array(479), '5.2'),
            array('fdf_get_flags', '5.3', array(480), '5.2'),
            array('fdf_get_opt', '5.3', array(481), '5.2'),
            array('fdf_get_status', '5.3', array(482), '5.2'),
            array('fdf_get_value', '5.3', array(483), '5.2'),
            array('fdf_get_version', '5.3', array(484), '5.2'),
            array('fdf_header', '5.3', array(485), '5.2'),
            array('fdf_next_field_name', '5.3', array(486), '5.2'),
            array('fdf_open_string', '5.3', array(487), '5.2'),
            array('fdf_open', '5.3', array(488), '5.2'),
            array('fdf_remove_item', '5.3', array(489), '5.2'),
            array('fdf_save_string', '5.3', array(490), '5.2'),
            array('fdf_save', '5.3', array(491), '5.2'),
            array('fdf_set_ap', '5.3', array(492), '5.2'),
            array('fdf_set_encoding', '5.3', array(493), '5.2'),
            array('fdf_set_file', '5.3', array(494), '5.2'),
            array('fdf_set_flags', '5.3', array(495), '5.2'),
            array('fdf_set_javascript_action', '5.3', array(496), '5.2'),
            array('fdf_set_on_import_javascript', '5.3', array(497), '5.2'),
            array('fdf_set_opt', '5.3', array(498), '5.2'),
            array('fdf_set_status', '5.3', array(499), '5.2'),
            array('fdf_set_submit_form_action', '5.3', array(500), '5.2'),
            array('fdf_set_target_frame', '5.3', array(501), '5.2'),
            array('fdf_set_value', '5.3', array(502), '5.2'),
            array('fdf_set_version', '5.3', array(503), '5.2'),
            array('ming_keypress', '5.3', array(506), '5.2'),
            array('ming_setcubicthreshold', '5.3', array(507), '5.2'),
            array('ming_setscale', '5.3', array(508), '5.2'),
            array('ming_setswfcompression', '5.3', array(509), '5.2'),
            array('ming_useconstants', '5.3', array(510), '5.2'),
            array('ming_useswfversion', '5.3', array(511), '5.2'),
            array('dbase_add_record', '5.3', array(708), '5.2'),
            array('dbase_close', '5.3', array(709), '5.2'),
            array('dbase_create', '5.3', array(710), '5.2'),
            array('dbase_delete_record', '5.3', array(711), '5.2'),
            array('dbase_get_header_info', '5.3', array(712), '5.2'),
            array('dbase_get_record_with_names', '5.3', array(713), '5.2'),
            array('dbase_get_record', '5.3', array(714), '5.2'),
            array('dbase_numfields', '5.3', array(715), '5.2'),
            array('dbase_numrecords', '5.3', array(716), '5.2'),
            array('dbase_open', '5.3', array(717), '5.2'),
            array('dbase_pack', '5.3', array(718), '5.2'),
            array('dbase_replace_record', '5.3', array(719), '5.2'),
            array('fbsql_affected_rows', '5.3', array(728), '5.2'),
            array('fbsql_autocommit', '5.3', array(729), '5.2'),
            array('fbsql_blob_size', '5.3', array(730), '5.2'),
            array('fbsql_change_user', '5.3', array(731), '5.2'),
            array('fbsql_clob_size', '5.3', array(732), '5.2'),
            array('fbsql_close', '5.3', array(733), '5.2'),
            array('fbsql_commit', '5.3', array(734), '5.2'),
            array('fbsql_connect', '5.3', array(735), '5.2'),
            array('fbsql_create_blob', '5.3', array(736), '5.2'),
            array('fbsql_create_clob', '5.3', array(737), '5.2'),
            array('fbsql_create_db', '5.3', array(738), '5.2'),
            array('fbsql_data_seek', '5.3', array(739), '5.2'),
            array('fbsql_database_password', '5.3', array(740), '5.2'),
            array('fbsql_database', '5.3', array(741), '5.2'),
            array('fbsql_db_query', '5.3', array(742), '5.2'),
            array('fbsql_db_status', '5.3', array(743), '5.2'),
            array('fbsql_drop_db', '5.3', array(744), '5.2'),
            array('fbsql_errno', '5.3', array(745), '5.2'),
            array('fbsql_error', '5.3', array(746), '5.2'),
            array('fbsql_fetch_array', '5.3', array(747), '5.2'),
            array('fbsql_fetch_assoc', '5.3', array(748), '5.2'),
            array('fbsql_fetch_field', '5.3', array(749), '5.2'),
            array('fbsql_fetch_lengths', '5.3', array(750), '5.2'),
            array('fbsql_fetch_object', '5.3', array(751), '5.2'),
            array('fbsql_fetch_row', '5.3', array(752), '5.2'),
            array('fbsql_field_flags', '5.3', array(753), '5.2'),
            array('fbsql_field_len', '5.3', array(754), '5.2'),
            array('fbsql_field_name', '5.3', array(755), '5.2'),
            array('fbsql_field_seek', '5.3', array(756), '5.2'),
            array('fbsql_field_table', '5.3', array(757), '5.2'),
            array('fbsql_field_type', '5.3', array(758), '5.2'),
            array('fbsql_free_result', '5.3', array(759), '5.2'),
            array('fbsql_get_autostart_info', '5.3', array(760), '5.2'),
            array('fbsql_hostname', '5.3', array(761), '5.2'),
            array('fbsql_insert_id', '5.3', array(762), '5.2'),
            array('fbsql_list_dbs', '5.3', array(763), '5.2'),
            array('fbsql_list_fields', '5.3', array(764), '5.2'),
            array('fbsql_list_tables', '5.3', array(765), '5.2'),
            array('fbsql_next_result', '5.3', array(766), '5.2'),
            array('fbsql_num_fields', '5.3', array(767), '5.2'),
            array('fbsql_num_rows', '5.3', array(768), '5.2'),
            array('fbsql_password', '5.3', array(769), '5.2'),
            array('fbsql_pconnect', '5.3', array(770), '5.2'),
            array('fbsql_query', '5.3', array(771), '5.2'),
            array('fbsql_read_blob', '5.3', array(772), '5.2'),
            array('fbsql_read_clob', '5.3', array(773), '5.2'),
            array('fbsql_result', '5.3', array(774), '5.2'),
            array('fbsql_rollback', '5.3', array(775), '5.2'),
            array('fbsql_rows_fetched', '5.3', array(776), '5.2'),
            array('fbsql_select_db', '5.3', array(777), '5.2'),
            array('fbsql_set_characterset', '5.3', array(778), '5.2'),
            array('fbsql_set_lob_mode', '5.3', array(779), '5.2'),
            array('fbsql_set_password', '5.3', array(780), '5.2'),
            array('fbsql_set_transaction', '5.3', array(781), '5.2'),
            array('fbsql_start_db', '5.3', array(782), '5.2'),
            array('fbsql_stop_db', '5.3', array(783), '5.2'),
            array('fbsql_table_name', '5.3', array(784), '5.2'),
            array('fbsql_tablename', '5.3', array(785), '5.2'),
            array('fbsql_username', '5.3', array(786), '5.2'),
            array('fbsql_warnings', '5.3', array(787), '5.2'),
            array('msql_affected_rows', '5.3', array(813), '5.2'),
            array('msql_close', '5.3', array(814), '5.2'),
            array('msql_connect', '5.3', array(815), '5.2'),
            array('msql_create_db', '5.3', array(816), '5.2'),
            array('msql_createdb', '5.3', array(817), '5.2'),
            array('msql_data_seek', '5.3', array(818), '5.2'),
            array('msql_db_query', '5.3', array(819), '5.2'),
            array('msql_dbname', '5.3', array(820), '5.2'),
            array('msql_drop_db', '5.3', array(821), '5.2'),
            array('msql_error', '5.3', array(822), '5.2'),
            array('msql_fetch_array', '5.3', array(823), '5.2'),
            array('msql_fetch_field', '5.3', array(824), '5.2'),
            array('msql_fetch_object', '5.3', array(825), '5.2'),
            array('msql_fetch_row', '5.3', array(826), '5.2'),
            array('msql_field_flags', '5.3', array(827), '5.2'),
            array('msql_field_len', '5.3', array(828), '5.2'),
            array('msql_field_name', '5.3', array(829), '5.2'),
            array('msql_field_seek', '5.3', array(830), '5.2'),
            array('msql_field_table', '5.3', array(831), '5.2'),
            array('msql_field_type', '5.3', array(832), '5.2'),
            array('msql_fieldflags', '5.3', array(833), '5.2'),
            array('msql_fieldlen', '5.3', array(834), '5.2'),
            array('msql_fieldname', '5.3', array(835), '5.2'),
            array('msql_fieldtable', '5.3', array(836), '5.2'),
            array('msql_fieldtype', '5.3', array(837), '5.2'),
            array('msql_free_result', '5.3', array(838), '5.2'),
            array('msql_list_dbs', '5.3', array(839), '5.2'),
            array('msql_list_fields', '5.3', array(840), '5.2'),
            array('msql_list_tables', '5.3', array(841), '5.2'),
            array('msql_num_fields', '5.3', array(842), '5.2'),
            array('msql_num_rows', '5.3', array(843), '5.2'),
            array('msql_numfields', '5.3', array(844), '5.2'),
            array('msql_numrows', '5.3', array(845), '5.2'),
            array('msql_pconnect', '5.3', array(846), '5.2'),
            array('msql_query', '5.3', array(847), '5.2'),
            array('msql_regcase', '5.3', array(848), '5.2'),
            array('msql_result', '5.3', array(849), '5.2'),
            array('msql_select_db', '5.3', array(850), '5.2'),
            array('msql_tablename', '5.3', array(851), '5.2'),
            array('msql', '5.3', array(852), '5.2'),
            array('mysqli_disable_reads_from_master', '5.3', array(1144), '5.2'),
            array('mysqli_disable_rpl_parse', '5.3', array(1145), '5.2'),
            array('mysqli_enable_reads_from_master', '5.3', array(1149), '5.2'),
            array('mysqli_enable_rpl_parse', '5.3', array(1150), '5.2'),
            array('mysqli_master_query', '5.3', array(1151), '5.2'),
            array('mysqli_rpl_parse_enabled', '5.3', array(1153), '5.2'),
            array('mysqli_rpl_probe', '5.3', array(1154), '5.2'),
            array('mysqli_slave_query', '5.3', array(1157), '5.2'),

            array('sqlite_array_query', '5.4', array(883), '5.3'),
            array('sqlite_busy_timeout', '5.4', array(884), '5.3'),
            array('sqlite_changes', '5.4', array(885), '5.3'),
            array('sqlite_close', '5.4', array(886), '5.3'),
            array('sqlite_column', '5.4', array(887), '5.3'),
            array('sqlite_create_aggregate', '5.4', array(888), '5.3'),
            array('sqlite_create_function', '5.4', array(889), '5.3'),
            array('sqlite_current', '5.4', array(890), '5.3'),
            array('sqlite_error_string', '5.4', array(891), '5.3'),
            array('sqlite_escape_string', '5.4', array(892), '5.3'),
            array('sqlite_exec', '5.4', array(893), '5.3'),
            array('sqlite_factory', '5.4', array(894), '5.3'),
            array('sqlite_fetch_all', '5.4', array(895), '5.3'),
            array('sqlite_fetch_array', '5.4', array(896), '5.3'),
            array('sqlite_fetch_column_types', '5.4', array(897), '5.3'),
            array('sqlite_fetch_object', '5.4', array(898), '5.3'),
            array('sqlite_fetch_single', '5.4', array(899), '5.3'),
            array('sqlite_fetch_string', '5.4', array(900), '5.3'),
            array('sqlite_field_name', '5.4', array(901), '5.3'),
            array('sqlite_has_more', '5.4', array(902), '5.3'),
            array('sqlite_has_prev', '5.4', array(903), '5.3'),
            array('sqlite_key', '5.4', array(904), '5.3'),
            array('sqlite_last_error', '5.4', array(905), '5.3'),
            array('sqlite_last_insert_rowid', '5.4', array(906), '5.3'),
            array('sqlite_libencoding', '5.4', array(907), '5.3'),
            array('sqlite_libversion', '5.4', array(908), '5.3'),
            array('sqlite_next', '5.4', array(909), '5.3'),
            array('sqlite_num_fields', '5.4', array(910), '5.3'),
            array('sqlite_num_rows', '5.4', array(911), '5.3'),
            array('sqlite_open', '5.4', array(912), '5.3'),
            array('sqlite_popen', '5.4', array(913), '5.3'),
            array('sqlite_prev', '5.4', array(914), '5.3'),
            array('sqlite_query', '5.4', array(915), '5.3'),
            array('sqlite_rewind', '5.4', array(916), '5.3'),
            array('sqlite_seek', '5.4', array(917), '5.3'),
            array('sqlite_single_query', '5.4', array(918), '5.3'),
            array('sqlite_udf_decode_binary', '5.4', array(919), '5.3'),
            array('sqlite_udf_encode_binary', '5.4', array(920), '5.3'),
            array('sqlite_unbuffered_query', '5.4', array(921), '5.3'),
            array('sqlite_valid', '5.4', array(922), '5.3'),

            array('php_logo_guid', '5.5', array(32), '5.4'),
            array('php_egg_logo_guid', '5.5', array(33), '5.4'),
            array('php_real_logo_guid', '5.5', array(34), '5.4'),
            array('imagepsbbox', '7.0', array(90), '5.6'),
            array('imagepsencodefont', '7.0', array(91), '5.6'),
            array('imagepsextendfont', '7.0', array(92), '5.6'),
            array('imagepsfreefont', '7.0', array(93), '5.6'),
            array('imagepsloadfont', '7.0', array(94), '5.6'),
            array('imagepsslantfont', '7.0', array(95), '5.6'),
            array('imagepstext', '7.0', array(96), '5.6'),
            array('mssql_bind', '7.0', array(853), '5.6'),
            array('mssql_close', '7.0', array(854), '5.6'),
            array('mssql_connect', '7.0', array(855), '5.6'),
            array('mssql_data_seek', '7.0', array(856), '5.6'),
            array('mssql_execute', '7.0', array(857), '5.6'),
            array('mssql_fetch_array', '7.0', array(858), '5.6'),
            array('mssql_fetch_assoc', '7.0', array(859), '5.6'),
            array('mssql_fetch_batch', '7.0', array(860), '5.6'),
            array('mssql_fetch_field', '7.0', array(861), '5.6'),
            array('mssql_fetch_object', '7.0', array(862), '5.6'),
            array('mssql_fetch_row', '7.0', array(863), '5.6'),
            array('mssql_field_length', '7.0', array(864), '5.6'),
            array('mssql_field_name', '7.0', array(865), '5.6'),
            array('mssql_field_seek', '7.0', array(866), '5.6'),
            array('mssql_field_type', '7.0', array(867), '5.6'),
            array('mssql_free_result', '7.0', array(868), '5.6'),
            array('mssql_free_statement', '7.0', array(869), '5.6'),
            array('mssql_get_last_message', '7.0', array(870), '5.6'),
            array('mssql_guid_string', '7.0', array(871), '5.6'),
            array('mssql_init', '7.0', array(872), '5.6'),
            array('mssql_min_error_severity', '7.0', array(873), '5.6'),
            array('mssql_min_message_severity', '7.0', array(874), '5.6'),
            array('mssql_next_result', '7.0', array(875), '5.6'),
            array('mssql_num_fields', '7.0', array(876), '5.6'),
            array('mssql_num_rows', '7.0', array(877), '5.6'),
            array('mssql_pconnect', '7.0', array(878), '5.6'),
            array('mssql_query', '7.0', array(879), '5.6'),
            array('mssql_result', '7.0', array(880), '5.6'),
            array('mssql_rows_affected', '7.0', array(881), '5.6'),
            array('mssql_select_db', '7.0', array(882), '5.6'),
            array('sybase_affected_rows', '7.0', array(1081), '5.6'),
            array('sybase_close', '7.0', array(1082), '5.6'),
            array('sybase_connect', '7.0', array(1083), '5.6'),
            array('sybase_data_seek', '7.0', array(1084), '5.6'),
            array('sybase_deadlock_retry_count', '7.0', array(1085), '5.6'),
            array('sybase_fetch_array', '7.0', array(1086), '5.6'),
            array('sybase_fetch_assoc', '7.0', array(1087), '5.6'),
            array('sybase_fetch_field', '7.0', array(1088), '5.6'),
            array('sybase_fetch_object', '7.0', array(1089), '5.6'),
            array('sybase_fetch_row', '7.0', array(1090), '5.6'),
            array('sybase_field_seek', '7.0', array(1091), '5.6'),
            array('sybase_free_result', '7.0', array(1092), '5.6'),
            array('sybase_get_last_message', '7.0', array(1093), '5.6'),
            array('sybase_min_client_severity', '7.0', array(1094), '5.6'),
            array('sybase_min_error_severity', '7.0', array(1095), '5.6'),
            array('sybase_min_message_severity', '7.0', array(1096), '5.6'),
            array('sybase_min_server_severity', '7.0', array(1097), '5.6'),
            array('sybase_num_fields', '7.0', array(1098), '5.6'),
            array('sybase_num_rows', '7.0', array(1099), '5.6'),
            array('sybase_pconnect', '7.0', array(1100), '5.6'),
            array('sybase_query', '7.0', array(1101), '5.6'),
            array('sybase_result', '7.0', array(1102), '5.6'),
            array('sybase_select_db', '7.0', array(1103), '5.6'),
            array('sybase_set_message_handler', '7.0', array(1104), '5.6'),
            array('sybase_unbuffered_query', '7.0', array(1105), '5.6'),

            array('php_check_syntax', '5.0.5', array(98), '5.0', '5.1'),
            array('mysqli_get_cache_stats', '5.4', array(99), '5.3'),
            array('ibase_add_user', '7.4', array(171), '7.3'),
            array('ibase_affected_rows', '7.4', array(172), '7.3'),
            array('ibase_backup', '7.4', array(173), '7.3'),
            array('ibase_blob_add', '7.4', array(174), '7.3'),
            array('ibase_blob_cancel', '7.4', array(175), '7.3'),
            array('ibase_blob_close', '7.4', array(176), '7.3'),
            array('ibase_blob_create', '7.4', array(177), '7.3'),
            array('ibase_blob_echo', '7.4', array(178), '7.3'),
            array('ibase_blob_get', '7.4', array(179), '7.3'),
            array('ibase_blob_import', '7.4', array(180), '7.3'),
            array('ibase_blob_info', '7.4', array(181), '7.3'),
            array('ibase_blob_open', '7.4', array(182), '7.3'),
            array('ibase_close', '7.4', array(183), '7.3'),
            array('ibase_commit_ret', '7.4', array(184), '7.3'),
            array('ibase_commit', '7.4', array(185), '7.3'),
            array('ibase_connect', '7.4', array(186), '7.3'),
            array('ibase_db_info', '7.4', array(187), '7.3'),
            array('ibase_delete_user', '7.4', array(188), '7.3'),
            array('ibase_drop_db', '7.4', array(189), '7.3'),
            array('ibase_errcode', '7.4', array(190), '7.3'),
            array('ibase_errmsg', '7.4', array(191), '7.3'),
            array('ibase_execute', '7.4', array(192), '7.3'),
            array('ibase_fetch_assoc', '7.4', array(193), '7.3'),
            array('ibase_fetch_object', '7.4', array(194), '7.3'),
            array('ibase_fetch_row', '7.4', array(195), '7.3'),
            array('ibase_field_info', '7.4', array(196), '7.3'),
            array('ibase_free_event_handler', '7.4', array(197), '7.3'),
            array('ibase_free_query', '7.4', array(198), '7.3'),
            array('ibase_free_result', '7.4', array(199), '7.3'),
            array('ibase_gen_id', '7.4', array(200), '7.3'),
            array('ibase_maintain_db', '7.4', array(201), '7.3'),
            array('ibase_modify_user', '7.4', array(202), '7.3'),
            array('ibase_name_result', '7.4', array(203), '7.3'),
            array('ibase_num_fields', '7.4', array(204), '7.3'),
            array('ibase_num_params', '7.4', array(205), '7.3'),
            array('ibase_param_info', '7.4', array(206), '7.3'),
            array('ibase_pconnect', '7.4', array(207), '7.3'),
            array('ibase_prepare', '7.4', array(208), '7.3'),
            array('ibase_query', '7.4', array(209), '7.3'),
            array('ibase_restore', '7.4', array(210), '7.3'),
            array('ibase_rollback_ret', '7.4', array(211), '7.3'),
            array('ibase_rollback', '7.4', array(212), '7.3'),
            array('ibase_server_info', '7.4', array(213), '7.3'),
            array('ibase_service_attach', '7.4', array(214), '7.3'),
            array('ibase_service_detach', '7.4', array(215), '7.3'),
            array('ibase_set_event_handler', '7.4', array(216), '7.3'),
            array('ibase_trans', '7.4', array(217), '7.3'),
            array('ibase_wait_event', '7.4', array(218), '7.3'),
            array('fbird_add_user', '7.4', array(987), '7.3'),
            array('fbird_affected_rows', '7.4', array(988), '7.3'),
            array('fbird_backup', '7.4', array(989), '7.3'),
            array('fbird_blob_add', '7.4', array(990), '7.3'),
            array('fbird_blob_cancel', '7.4', array(991), '7.3'),
            array('fbird_blob_close', '7.4', array(992), '7.3'),
            array('fbird_blob_create', '7.4', array(993), '7.3'),
            array('fbird_blob_echo', '7.4', array(994), '7.3'),
            array('fbird_blob_get', '7.4', array(995), '7.3'),
            array('fbird_blob_import', '7.4', array(996), '7.3'),
            array('fbird_blob_info', '7.4', array(997), '7.3'),
            array('fbird_blob_open', '7.4', array(998), '7.3'),
            array('fbird_close', '7.4', array(999), '7.3'),
            array('fbird_commit_ret', '7.4', array(1000), '7.3'),
            array('fbird_commit', '7.4', array(1001), '7.3'),
            array('fbird_connect', '7.4', array(1002), '7.3'),
            array('fbird_db_info', '7.4', array(1003), '7.3'),
            array('fbird_delete_user', '7.4', array(1004), '7.3'),
            array('fbird_drop_db', '7.4', array(1005), '7.3'),
            array('fbird_errcode', '7.4', array(1006), '7.3'),
            array('fbird_errmsg', '7.4', array(1007), '7.3'),
            array('fbird_execute', '7.4', array(1008), '7.3'),
            array('fbird_fetch_assoc', '7.4', array(1009), '7.3'),
            array('fbird_fetch_object', '7.4', array(1010), '7.3'),
            array('fbird_fetch_row', '7.4', array(1011), '7.3'),
            array('fbird_field_info', '7.4', array(1012), '7.3'),
            array('fbird_free_event_handler', '7.4', array(1013), '7.3'),
            array('fbird_free_query', '7.4', array(1014), '7.3'),
            array('fbird_free_result', '7.4', array(1015), '7.3'),
            array('fbird_gen_id', '7.4', array(1016), '7.3'),
            array('fbird_maintain_db', '7.4', array(1017), '7.3'),
            array('fbird_modify_user', '7.4', array(1018), '7.3'),
            array('fbird_name_result', '7.4', array(1019), '7.3'),
            array('fbird_num_fields', '7.4', array(1020), '7.3'),
            array('fbird_num_params', '7.4', array(1021), '7.3'),
            array('fbird_param_info', '7.4', array(1022), '7.3'),
            array('fbird_pconnect', '7.4', array(1023), '7.3'),
            array('fbird_prepare', '7.4', array(1024), '7.3'),
            array('fbird_query', '7.4', array(1025), '7.3'),
            array('fbird_restore', '7.4', array(1026), '7.3'),
            array('fbird_rollback_ret', '7.4', array(1027), '7.3'),
            array('fbird_rollback', '7.4', array(1028), '7.3'),
            array('fbird_server_info', '7.4', array(1029), '7.3'),
            array('fbird_service_attach', '7.4', array(1030), '7.3'),
            array('fbird_service_detach', '7.4', array(1031), '7.3'),
            array('fbird_set_event_handler', '7.4', array(1032), '7.3'),
            array('fbird_trans', '7.4', array(1033), '7.3'),
            array('fbird_wait_event', '7.4', array(1034), '7.3'),

            array('wddx_add_vars', '7.4', array(228), '7.3'),
            array('wddx_deserialize', '7.4', array(229), '7.3'),
            array('wddx_packet_end', '7.4', array(230), '7.3'),
            array('wddx_packet_start', '7.4', array(231), '7.3'),
            array('wddx_serialize_value', '7.4', array(232), '7.3'),
            array('wddx_serialize_vars', '7.4', array(233), '7.3'),
            array('mysqli_embedded_server_end', '7.4', array(1147), '7.3'),
            array('mysqli_embedded_server_start', '7.4', array(1148), '7.3'),

            array('xmlrpc_decode_request', '8.0', array(1158), '7.4'),
            array('xmlrpc_decode', '8.0', array(1159), '7.4'),
            array('xmlrpc_encode_request', '8.0', array(1160), '7.4'),
            array('xmlrpc_encode', '8.0', array(1161), '7.4'),
            array('xmlrpc_get_type', '8.0', array(1162), '7.4'),
            array('xmlrpc_is_fault', '8.0', array(1163), '7.4'),
            array('xmlrpc_parse_method_descriptions', '8.0', array(1164), '7.4'),
            array('xmlrpc_server_add_introspection_data', '8.0', array(1165), '7.4'),
            array('xmlrpc_server_call_method', '8.0', array(1166), '7.4'),
            array('xmlrpc_server_create', '8.0', array(1167), '7.4'),
            array('xmlrpc_server_destroy', '8.0', array(1168), '7.4'),
            array('xmlrpc_server_register_introspection_callback', '8.0', array(1169), '7.4'),
            array('xmlrpc_server_register_method', '8.0', array(1170), '7.4'),
            array('xmlrpc_set_type', '8.0', array(1171), '7.4'),
        );
    }


    /**
     * testRemovedFunctionWithAlternative
     *
     * @dataProvider dataRemovedFunctionWithAlternative
     *
     * @param string $functionName   Name of the function.
     * @param string $removedIn      The PHP version in which the function was removed.
     * @param string $alternative    An alternative function.
     * @param array  $lines          The line numbers in the test file which apply to this function.
     * @param string $okVersion      A PHP version in which the function was still valid.
     * @param string $removedVersion Optional PHP version to test removed message with -
     *                               if different from the $removedIn version.
     *
     * @return void
     */
    public function testRemovedFunctionWithAlternative($functionName, $removedIn, $alternative, $lines, $okVersion, $removedVersion = null)
    {
        $file = $this->sniffFile(__FILE__, $okVersion);
        foreach ($lines as $line) {
            $this->assertNoViolation($file, $line);
        }

        $errorVersion = (isset($removedVersion)) ? $removedVersion : $removedIn;
        $file         = $this->sniffFile(__FILE__, $errorVersion);
        $error        = "Function {$functionName}() is removed since PHP {$removedIn}; Use {$alternative} instead";
        foreach ($lines as $line) {
            $this->assertError($file, $line, $error);
        }
    }

    /**
     * Data provider.
     *
     * @see testRemovedFunctionWithAlternative()
     *
     * @return array
     */
    public function dataRemovedFunctionWithAlternative()
    {
        return array(
            array('zend_logo_guid', '5.5', 'text string "PHPE9568F35-D428-11d2-A769-00AA001ACF42"', array(35), '5.4'),

            array('recode_file', '7.4', 'the iconv or mbstring extension', array(236), '7.3'),
            array('recode_string', '7.4', 'the iconv or mbstring extension', array(237), '7.3'),
            array('recode', '7.4', 'the iconv or mbstring extension', array(238), '7.3'),
        );
    }


    /**
     * testDeprecatedRemovedFunction
     *
     * @dataProvider dataDeprecatedRemovedFunction
     *
     * @param string $functionName      Name of the function.
     * @param string $deprecatedIn      The PHP version in which the function was deprecated.
     * @param string $removedIn         The PHP version in which the function was removed.
     * @param array  $lines             The line numbers in the test file which apply to this function.
     * @param string $okVersion         A PHP version in which the function was still valid.
     * @param string $deprecatedVersion Optional PHP version to test deprecation message with -
     *                                  if different from the $deprecatedIn version.
     * @param string $removedVersion    Optional PHP version to test removed message with -
     *                                  if different from the $removedIn version.
     *
     * @return void
     */
    public function testDeprecatedRemovedFunction($functionName, $deprecatedIn, $removedIn, $lines, $okVersion, $deprecatedVersion = null, $removedVersion = null)
    {
        $file = $this->sniffFile(__FILE__, $okVersion);
        foreach ($lines as $line) {
            $this->assertNoViolation($file, $line);
        }

        $errorVersion = (isset($deprecatedVersion)) ? $deprecatedVersion : $deprecatedIn;
        $file         = $this->sniffFile(__FILE__, $errorVersion);
        $error        = "Function {$functionName}() is deprecated since PHP {$deprecatedIn}";
        foreach ($lines as $line) {
            $this->assertWarning($file, $line, $error);
        }

        $errorVersion = (isset($removedVersion)) ? $removedVersion : $removedIn;
        $file         = $this->sniffFile(__FILE__, $errorVersion);
        $error        = "Function {$functionName}() is deprecated since PHP {$deprecatedIn} and removed since PHP {$removedIn}";
        foreach ($lines as $line) {
            $this->assertError($file, $line, $error);
        }
    }

    /**
     * Data provider.
     *
     * @see testDeprecatedRemovedFunction()
     *
     * @return array
     */
    public function dataDeprecatedRemovedFunction()
    {
        return array(
            array('define_syslog_variables', '5.3', '5.4', array(5), '5.2'),
            array('import_request_variables', '5.3', '5.4', array(11), '5.2'),
            array('mysql_list_dbs', '5.4', '7.0', array(15), '5.3'),
            array('magic_quotes_runtime', '5.3', '7.0', array(23), '5.2'),
            array('set_magic_quotes_runtime', '5.3', '7.0', array(27), '5.2'),
            array('sql_regcase', '5.3', '7.0', array(31), '5.2'),
            array('mysql_affected_rows', '5.5', '7.0', array(923), '5.4'),
            array('mysql_client_encoding', '5.5', '7.0', array(924), '5.4'),
            array('mysql_close', '5.5', '7.0', array(925), '5.4'),
            array('mysql_connect', '5.5', '7.0', array(926), '5.4'),
            array('mysql_create_db', '4.3', '7.0', array(927), '4.2'),
            array('mysql_data_seek', '5.5', '7.0', array(928), '5.4'),
            array('mysql_db_name', '5.5', '7.0', array(929), '5.4'),
            array('mysql_drop_db', '4.3', '7.0', array(930), '4.2'),
            array('mysql_errno', '5.5', '7.0', array(931), '5.4'),
            array('mysql_error', '5.5', '7.0', array(932), '5.4'),
            array('mysql_fetch_array', '5.5', '7.0', array(933), '5.4'),
            array('mysql_fetch_assoc', '5.5', '7.0', array(934), '5.4'),
            array('mysql_fetch_field', '5.5', '7.0', array(935), '5.4'),
            array('mysql_fetch_lengths', '5.5', '7.0', array(936), '5.4'),
            array('mysql_fetch_object', '5.5', '7.0', array(937), '5.4'),
            array('mysql_fetch_row', '5.5', '7.0', array(938), '5.4'),
            array('mysql_field_flags', '5.5', '7.0', array(939), '5.4'),
            array('mysql_field_len', '5.5', '7.0', array(940), '5.4'),
            array('mysql_field_name', '5.5', '7.0', array(941), '5.4'),
            array('mysql_field_seek', '5.5', '7.0', array(942), '5.4'),
            array('mysql_field_table', '5.5', '7.0', array(943), '5.4'),
            array('mysql_field_type', '5.5', '7.0', array(944), '5.4'),
            array('mysql_free_result', '5.5', '7.0', array(945), '5.4'),
            array('mysql_get_client_info', '5.5', '7.0', array(946), '5.4'),
            array('mysql_get_host_info', '5.5', '7.0', array(947), '5.4'),
            array('mysql_get_proto_info', '5.5', '7.0', array(948), '5.4'),
            array('mysql_get_server_info', '5.5', '7.0', array(949), '5.4'),
            array('mysql_info', '5.5', '7.0', array(950), '5.4'),
            array('mysql_insert_id', '5.5', '7.0', array(951), '5.4'),
            array('mysql_list_fields', '5.4', '7.0', array(952), '5.3'),
            array('mysql_list_processes', '5.5', '7.0', array(953), '5.4'),
            array('mysql_list_tables', '4.3.7', '7.0', array(954), '4.3', '4.4'),
            array('mysql_num_fields', '5.5', '7.0', array(955), '5.4'),
            array('mysql_num_rows', '5.5', '7.0', array(956), '5.4'),
            array('mysql_pconnect', '5.5', '7.0', array(957), '5.4'),
            array('mysql_ping', '5.5', '7.0', array(958), '5.4'),
            array('mysql_query', '5.5', '7.0', array(959), '5.4'),
            array('mysql_real_escape_string', '5.5', '7.0', array(960), '5.4'),
            array('mysql_result', '5.5', '7.0', array(961), '5.4'),
            array('mysql_select_db', '5.5', '7.0', array(962), '5.4'),
            array('mysql_set_charset', '5.5', '7.0', array(963), '5.4'),
            array('mysql_stat', '5.5', '7.0', array(964), '5.4'),
            array('mysql_tablename', '5.5', '7.0', array(965), '5.4'),
            array('mysql_thread_id', '5.5', '7.0', array(966), '5.4'),
            array('mysql_unbuffered_query', '5.5', '7.0', array(967), '5.4'),
            array('mysql', '5.5', '7.0', array(968), '5.4'),
            array('mysql_fieldname', '5.5', '7.0', array(969), '5.4'),
            array('mysql_fieldtable', '5.5', '7.0', array(970), '5.4'),
            array('mysql_fieldlen', '5.5', '7.0', array(971), '5.4'),
            array('mysql_fieldtype', '5.5', '7.0', array(972), '5.4'),
            array('mysql_fieldflags', '5.5', '7.0', array(973), '5.4'),
            array('mysql_selectdb', '5.5', '7.0', array(974), '5.4'),
            array('mysql_freeresult', '5.5', '7.0', array(977), '5.4'),
            array('mysql_numfields', '5.5', '7.0', array(978), '5.4'),
            array('mysql_numrows', '5.5', '7.0', array(979), '5.4'),
            array('mysql_listdbs', '5.5', '7.0', array(980), '5.4'),
            array('mysql_listfields', '5.5', '7.0', array(982), '5.4'),
            array('mysql_dbname', '5.5', '7.0', array(983), '5.4'),
            array('mysql_table_name', '5.5', '7.0', array(984), '5.4'),

        );
    }


    /**
     * testDeprecatedRemovedFunctionWithAlternative
     *
     * @dataProvider dataDeprecatedRemovedFunctionWithAlternative
     *
     * @param string $functionName      Name of the function.
     * @param string $deprecatedIn      The PHP version in which the function was deprecated.
     * @param string $removedIn         The PHP version in which the function was removed.
     * @param string $alternative       An alternative function.
     * @param array  $lines             The line numbers in the test file which apply to this function.
     * @param string $okVersion         A PHP version in which the function was still valid.
     * @param string $deprecatedVersion Optional PHP version to test deprecation message with -
     *                                  if different from the $deprecatedIn version.
     * @param string $removedVersion    Optional PHP version to test removed message with -
     *                                  if different from the $removedIn version.
     *
     * @return void
     */
    public function testDeprecatedRemovedFunctionWithAlternative($functionName, $deprecatedIn, $removedIn, $alternative, $lines, $okVersion, $deprecatedVersion = null, $removedVersion = null)
    {
        $file = $this->sniffFile(__FILE__, $okVersion);
        foreach ($lines as $line) {
            $this->assertNoViolation($file, $line);
        }

        $errorVersion = (isset($deprecatedVersion)) ? $deprecatedVersion : $deprecatedIn;
        $file         = $this->sniffFile(__FILE__, $errorVersion);
        $error        = "Function {$functionName}() is deprecated since PHP {$deprecatedIn}; Use {$alternative} instead";
        foreach ($lines as $line) {
            $this->assertWarning($file, $line, $error);
        }

        $errorVersion = (isset($removedVersion)) ? $removedVersion : $removedIn;
        $file         = $this->sniffFile(__FILE__, $errorVersion);
        $error        = "Function {$functionName}() is deprecated since PHP {$deprecatedIn} and removed since PHP {$removedIn}; Use {$alternative} instead";
        foreach ($lines as $line) {
            $this->assertError($file, $line, $error);
        }
    }

    /**
     * Data provider.
     *
     * @see testDeprecatedRemovedFunctionWithAlternative()
     *
     * @return array
     */
    public function dataDeprecatedRemovedFunctionWithAlternative()
    {
        return array(
            array('call_user_method', '4.1', '7.0', 'call_user_func()', array(3), '4.0'),
            array('call_user_method_array', '4.1', '7.0', 'call_user_func_array()', array(4), '4.0'),
            array('ereg', '5.3', '7.0', 'preg_match()', array(7), '5.2'),
            array('ereg_replace', '5.3', '7.0', 'preg_replace()', array(8), '5.2'),
            array('eregi', '5.3', '7.0', 'preg_match() (with the i modifier)', array(9), '5.2'),
            array('eregi_replace', '5.3', '7.0', 'preg_replace() (with the i modifier)', array(10), '5.2'),
            array('mcrypt_generic_end', '5.3', '7.0', 'mcrypt_generic_deinit()', array(12), '5.2'),
            array('mcrypt_ecb', '5.5', '7.0', 'mcrypt_decrypt()/mcrypt_encrypt()', array(37), '5.4'),
            array('mcrypt_cbc', '5.5', '7.0', 'mcrypt_decrypt()/mcrypt_encrypt()', array(38), '5.4'),
            array('mcrypt_cfb', '5.5', '7.0', 'mcrypt_decrypt()/mcrypt_encrypt()', array(39), '5.4'),
            array('mcrypt_ofb', '5.5', '7.0', 'mcrypt_decrypt()/mcrypt_encrypt()', array(40), '5.4'),
            array('mysql_db_query', '5.3', '7.0', 'mysqli::select_db() and mysqli::query()', array(13), '5.2'),
            array('mysql_escape_string', '4.3', '7.0', 'mysqli::real_escape_string()', array(14), '4.2'),
            array('mysqli_bind_param', '5.3', '5.4', 'mysqli_stmt::bind_param()', array(16), '5.2'),
            array('mysqli_bind_result', '5.3', '5.4', 'mysqli_stmt::bind_result()', array(17), '5.2'),
            array('mysqli_client_encoding', '5.3', '5.4', 'mysqli::character_set_name()', array(18), '5.2'),
            array('mysqli_fetch', '5.3', '5.4', 'mysqli_stmt::fetch()', array(19), '5.2'),
            array('mysqli_param_count', '5.3', '5.4', 'mysqli_stmt_param_count()', array(20), '5.2'),
            array('mysqli_get_metadata', '5.3', '5.4', 'mysqli_stmt::result_metadata()', array(21), '5.2'),
            array('mysqli_send_long_data', '5.3', '5.4', 'mysqli_stmt::send_long_data()', array(22), '5.2'),
            array('session_register', '5.3', '5.4', '$_SESSION', array(24), '5.2'),
            array('session_unregister', '5.3', '5.4', '$_SESSION', array(25), '5.2'),
            array('session_is_registered', '5.3', '5.4', '$_SESSION', array(26), '5.2'),
            array('set_socket_blocking', '5.3', '7.0', 'stream_set_blocking()', array(28), '5.2'),
            array('split', '5.3', '7.0', 'preg_split(), explode() or str_split()', array(29), '5.2'),
            array('spliti', '5.3', '7.0', 'preg_split() (with the i modifier)', array(30), '5.2'),
            array('datefmt_set_timezone_id', '5.5', '7.0', 'IntlDateFormatter::setTimeZone()', array(36), '5.4'),

            array('mcrypt_create_iv', '7.1', '7.2', 'random_bytes() or OpenSSL', array(100), '7.0'),
            array('mcrypt_decrypt', '7.1', '7.2', 'OpenSSL', array(101), '7.0'),
            array('mcrypt_enc_get_algorithms_name', '7.1', '7.2', 'OpenSSL', array(102), '7.0'),
            array('mcrypt_enc_get_block_size', '7.1', '7.2', 'OpenSSL', array(103), '7.0'),
            array('mcrypt_enc_get_iv_size', '7.1', '7.2', 'OpenSSL', array(104), '7.0'),
            array('mcrypt_enc_get_key_size', '7.1', '7.2', 'OpenSSL', array(105), '7.0'),
            array('mcrypt_enc_get_modes_name', '7.1', '7.2', 'OpenSSL', array(106), '7.0'),
            array('mcrypt_enc_get_supported_key_sizes', '7.1', '7.2', 'OpenSSL', array(107), '7.0'),
            array('mcrypt_enc_is_block_algorithm_mode', '7.1', '7.2', 'OpenSSL', array(108), '7.0'),
            array('mcrypt_enc_is_block_algorithm', '7.1', '7.2', 'OpenSSL', array(109), '7.0'),
            array('mcrypt_enc_is_block_mode', '7.1', '7.2', 'OpenSSL', array(110), '7.0'),
            array('mcrypt_enc_self_test', '7.1', '7.2', 'OpenSSL', array(111), '7.0'),
            array('mcrypt_encrypt', '7.1', '7.2', 'OpenSSL', array(112), '7.0'),
            array('mcrypt_generic_deinit', '7.1', '7.2', 'OpenSSL', array(113), '7.0'),
            array('mcrypt_generic_init', '7.1', '7.2', 'OpenSSL', array(114), '7.0'),
            array('mcrypt_generic', '7.1', '7.2', 'OpenSSL', array(115), '7.0'),
            array('mcrypt_get_block_size', '7.1', '7.2', 'OpenSSL', array(116), '7.0'),
            array('mcrypt_get_cipher_name', '7.1', '7.2', 'OpenSSL', array(117), '7.0'),
            array('mcrypt_get_iv_size', '7.1', '7.2', 'OpenSSL', array(118), '7.0'),
            array('mcrypt_get_key_size', '7.1', '7.2', 'OpenSSL', array(119), '7.0'),
            array('mcrypt_list_algorithms', '7.1', '7.2', 'OpenSSL', array(120), '7.0'),
            array('mcrypt_list_modes', '7.1', '7.2', 'OpenSSL', array(121), '7.0'),
            array('mcrypt_module_close', '7.1', '7.2', 'OpenSSL', array(122), '7.0'),
            array('mcrypt_module_get_algo_block_size', '7.1', '7.2', 'OpenSSL', array(123), '7.0'),
            array('mcrypt_module_get_algo_key_size', '7.1', '7.2', 'OpenSSL', array(124), '7.0'),
            array('mcrypt_module_get_supported_key_sizes', '7.1', '7.2', 'OpenSSL', array(125), '7.0'),
            array('mcrypt_module_is_block_algorithm_mode', '7.1', '7.2', 'OpenSSL', array(126), '7.0'),
            array('mcrypt_module_is_block_algorithm', '7.1', '7.2', 'OpenSSL', array(127), '7.0'),
            array('mcrypt_module_is_block_mode', '7.1', '7.2', 'OpenSSL', array(128), '7.0'),
            array('mcrypt_module_open', '7.1', '7.2', 'OpenSSL', array(129), '7.0'),
            array('mcrypt_module_self_test', '7.1', '7.2', 'OpenSSL', array(130), '7.0'),
            array('mdecrypt_generic', '7.1', '7.2', 'OpenSSL', array(131), '7.0'),

        );
    }


    /**
     * testNoFalsePositives
     *
     * @dataProvider dataNoFalsePositives
     *
     * @param int $line The line number.
     *
     * @return void
     */
    public function testNoFalsePositives($line)
    {
        $file = $this->sniffFile(__FILE__, '99.0'); // High version beyond latest deprecation.
        $this->assertNoViolation($file, $line);
    }

    /**
     * Data provider.
     *
     * @see testNoFalsePositives()
     *
     * @return array
     */
    public function dataNoFalsePositives()
    {
        return array(
            array(134),
            array(135),
            array(136),
            array(137),
            array(138),
            array(139),
            array(140),
            array(141),
            array(249),
            array(250),
            array(251),
            array(252),
        );
    }


    /**
     * Verify no notices are thrown at all.
     *
     * @return void
     */
    public function testNoViolationsInFileOnValidVersion()
    {
        $file = $this->sniffFile(__FILE__, '4.0'); // Low version below the first deprecation.
        $this->assertNoViolation($file);
    }
}
