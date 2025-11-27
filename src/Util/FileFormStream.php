<?php

namespace AlibabaCloud\Dara\Util;

use Psr\Http\Message\StreamInterface;

// 根据 PHP 版本动态加载对应的实现
if (PHP_VERSION_ID >= 70000) {
    // PHP 7.0+ 支持返回类型声明
    require_once __DIR__ . '/FileFormStreamTyped.php';
    
    if (!class_exists('AlibabaCloud\\Dara\\Util\\FileFormStream', false)) {
        class_alias('AlibabaCloud\\Dara\\Util\\FileFormStreamTyped', 'AlibabaCloud\\Dara\\Util\\FileFormStream');
    }
} else {
    // PHP 5.6-6.x 不支持返回类型声明
    /**
     * @internal
     * @coversNothing
     */
    class FileFormStream implements StreamInterface
    {
        use FileFormStreamTrait;

        public function getContents() { return $this->getContentsImpl(); }
        public function close() { $this->closeImpl(); }
        public function detach() { return $this->detachImpl(); }
        public function getSize() { return $this->getSizeImpl(); }
        public function tell() { return $this->tellImpl(); }
        public function eof() { return $this->eofImpl(); }
        public function isSeekable() { return $this->isSeekableImpl(); }
        public function seek($offset, $whence = SEEK_SET) { $this->seekImpl($offset, $whence); }
        public function rewind() { $this->rewindImpl(); }
        public function isWritable() { return $this->isWritableImpl(); }
        public function write($string) { return $this->writeImpl($string); }
        public function isReadable() { return $this->isReadableImpl(); }
        public function read($length) { return $this->readImpl($length); }
        public function getMetadata($key = null) { return $this->getMetadataImpl($key); }
    }
}