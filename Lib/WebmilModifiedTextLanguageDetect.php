<?php
namespace Webmil\TextLanguageDetectBundle\Lib;

/**
 * Created by JetBrains PhpStorm.
 * User: blacky
 * Date: 15.03.12
 * Time: 11:13
 * To change this template use File | Settings | File Templates.
 */
class WebmilModifiedTextLanguageDetect
{

    public function __construct(\TextLanguageDetect\TextLanguageDetect $TextLanguageDetect, array $params)
    {
        $this->_textLanguageDetect = $TextLanguageDetect;
        $this->_params = $params['omit_languages']['omit_list'];
        $this->_min_similarity_score = 0.2;
        $this->_textLanguageDetect->omitLanguages(array('latin', 'pidgin', 'lithuanian', 'turkish', 'indonesian', 'somali', 'swahili',
                                                      'mongolian', 'bengali', 'azeri', 'tagalog', 'hawaiian', 'vietnamese'));
    }


    /**
     * Returns only the most similar language to the text sample
     *
     * @param string $text text to detect the language of
     *
     * @return array
     */
    public function detect($text)
    {
        $scores = $this->_textLanguageDetect->detect($text);
        print_r($scores);
        $this->_changeWeights(mb_strtolower($text), $scores);
        print_r($scores);
        //get the first language scores
        $result['language'] = key($scores);
        $result['similarity'] = current($scores);

        if (!in_array($result['language'], $this->_params) || $result['similarity'] < $this->_min_similarity_score) {
            $result['language'] = 'unknown';
            $result['similarity'] = 1;
        }

        return $result;
    }


    /**
     * Modify languages weights by searching letters from given languages and modifying similarity factor
     * scores parameter will be replaced with new sorted array of language scores
     *
     * @param string $text   text to work with
     * @param array  $scores scores that was received after language detection
     *
     * @return array array of modified
     */
    private function _changeWeights($text, &$scores)
    {
        $weights = array(
            'norwegian' => array(
                'æ' => 0.005,
                'ø' => 0.006,
                'å' => 0.005,
            ),
            'danish'    => array(
                'æ' => 0.005,
                'ø' => 0.005,
                'å' => 0.005,
            ),
            'swedish'   => array(
                'å'=> 0.01,
                'ä'=> 0.001,
                'ö'=> 0.001,
            ),
            'spanish'   => array(
                'ñ' => 0.1
            )
        );

        foreach ($weights as $langName => $letterScore) {

            foreach ($letterScore as $letter => $score) {
                $letterCount = mb_substr_count($text, $letter);

                @$scores[$langName] = $scores[$langName] + ($letterCount * $score);
            }
        }
        //sort with new wieghts
        arsort($scores);
    }
}
