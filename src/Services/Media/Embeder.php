<?php namespace Ss\Services\Media;

use MediaEmbed\MediaEmbed;

class Embeder
{
    /**
     * @var
     */
    protected $mediaEmbeder;

    /**
     * Convenience function to embed media
     *
     * @param $text
     * @return mixed
     */
    public static function embed($text)
    {
        $embeder = new Embeder();
        return $embeder->autoLink($text);
    }

    /**
     * Runs the regex in order to find links to embed within text
     *
     * @param $text
     * @return mixed
     */
    public function autoLink($text)
    {
        return preg_replace_callback('#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si',
            [&$this, 'linkUrls'], $text);
    }

    /**
     * Links any matches within the given text
     *
     * @param $matches
     * @return string
     */
    protected function linkUrls($matches)
    {
        if (!isset($this->mediaEmbeder)) {
            $this->mediaEmbeder = new MediaEmbed();
        }

        $url = $matches[0];

        // for videos
        if ($MediaObject = $this->mediaEmbeder->parseUrl($url)) {
            return '<div class="responsive-video">' . $MediaObject->getEmbedCode() . '</div>';
        }

        // for images
        if (preg_match('~(http.*\.)(jpe?g|png|[tg]iff?|svg)~i', $url)) {
            return '<div><a href="' . $url . '" target="_blank"><img class="img-responsive" src="' . $url . '"></a></div>';
        }

        // if all else fails
        return '<a href="' . $url . '" target="_blank">' . $url . '</a>';
    }
}
