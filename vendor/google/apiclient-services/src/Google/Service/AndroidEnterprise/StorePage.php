<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

class Google_Service_AndroidEnterprise_StorePage extends Google_Collection {
    protected $collection_key = 'name';
    public $id;
    public $kind;
    public $link;
    protected $nameType       = 'Google_Service_AndroidEnterprise_LocalizedText';
    protected $nameDataType   = 'array';

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setKind($kind) {
        $this->kind = $kind;
    }

    public function getKind() {
        return $this->kind;
    }

    public function setLink($link) {
        $this->link = $link;
    }

    public function getLink() {
        return $this->link;
    }

    /**
     * @param Google_Service_AndroidEnterprise_LocalizedText
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return Google_Service_AndroidEnterprise_LocalizedText
     */
    public function getName() {
        return $this->name;
    }
}