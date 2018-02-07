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

class Google_Service_YouTube_LiveChatMessageAuthorDetails extends Google_Model {
    public $channelId;
    public $channelUrl;
    public $displayName;
    public $isChatModerator;
    public $isChatOwner;
    public $isChatSponsor;
    public $isVerified;
    public $profileImageUrl;

    public function setChannelId($channelId) {
        $this->channelId = $channelId;
    }

    public function getChannelId() {
        return $this->channelId;
    }

    public function setChannelUrl($channelUrl) {
        $this->channelUrl = $channelUrl;
    }

    public function getChannelUrl() {
        return $this->channelUrl;
    }

    public function setDisplayName($displayName) {
        $this->displayName = $displayName;
    }

    public function getDisplayName() {
        return $this->displayName;
    }

    public function setIsChatModerator($isChatModerator) {
        $this->isChatModerator = $isChatModerator;
    }

    public function getIsChatModerator() {
        return $this->isChatModerator;
    }

    public function setIsChatOwner($isChatOwner) {
        $this->isChatOwner = $isChatOwner;
    }

    public function getIsChatOwner() {
        return $this->isChatOwner;
    }

    public function setIsChatSponsor($isChatSponsor) {
        $this->isChatSponsor = $isChatSponsor;
    }

    public function getIsChatSponsor() {
        return $this->isChatSponsor;
    }

    public function setIsVerified($isVerified) {
        $this->isVerified = $isVerified;
    }

    public function getIsVerified() {
        return $this->isVerified;
    }

    public function setProfileImageUrl($profileImageUrl) {
        $this->profileImageUrl = $profileImageUrl;
    }

    public function getProfileImageUrl() {
        return $this->profileImageUrl;
    }
}