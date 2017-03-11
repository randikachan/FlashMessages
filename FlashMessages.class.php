<?php

/**
 * Created by PhpStorm.
 * User: Randika Chandrapala
 * Date: 2/20/17
 * Time: 7:53 AM
 *
 * MIT License
 *
 * Copyright (c) 2017 Kasun Randika
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 */
class FlashMessages
{
    function initSession() {
        // Check if a session exists
        if (!self::checkForSession()) {
            // if no session exist then start a new session
            self::startSession();
        }
    }

    function checkForSession() {
        if (session_id()) {
            return true;
        } else {
            return false;
        }
    }

    function startSession() {
        session_start();
    }

    function unsetSessionVariable($key = null) {
        if ($key) {
            self::initSession();
            if (!empty($_SESSION[$key])) {
                unset($_SESSION[$key]);
            }
        }
    }

    function flashMessage($key = null, $data = array()) {
        self::initSession();

        // we must have a Key to store data in reference
        if ($key) {
            // Check if the data we are going to store is not empty and valid, and we aren't going to overwrite it
            if (!empty($data) && empty($_SESSION[$key])) {
                $_SESSION[$key] = $data;
                return true;
            // Check if data exists for the key in the SESSION and if so let's return it
            } elseif (!empty($_SESSION[$key]) && empty($data)) {
                $tempData = $_SESSION[$key];
                unset($_SESSION[$key]);
                return $tempData;
            }
        }

        return false;
    }
}