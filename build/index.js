/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/modules/friends.js":
/*!********************************!*\
  !*** ./src/modules/friends.js ***!
  \********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);


class Friends {
  constructor() {
    this.events();
  }

  events() {
    jquery__WEBPACK_IMPORTED_MODULE_0___default()('.sugFriends__list').on('click', '.addFriendsButton', this.addFriend);
  }

  addFriend(e) {
    let addedFriend = jquery__WEBPACK_IMPORTED_MODULE_0___default()(e.target).parents('a');
    let addedFriendBtn = jquery__WEBPACK_IMPORTED_MODULE_0___default()(e.target);
    let followingCount = jquery__WEBPACK_IMPORTED_MODULE_0___default()('#following-count');
    jquery__WEBPACK_IMPORTED_MODULE_0___default().ajax({
      beforeSend: xhr => {
        xhr.setRequestHeader('X-WP-Nonce', friendmeData.nonce);
      },
      url: `${friendmeData.root_url}/wp-json/friendme/v1/friends?id=${addedFriend.attr("data-id")}`,
      type: 'POST',
      success: res => {
        console.log('Success');
        console.log(res);
        addedFriend.slideUp();
        followingCount.text(res);
      },
      error: res => {
        console.log('Error');
        console.log(res);
      }
    });
  }

}

/* harmony default export */ __webpack_exports__["default"] = (Friends);

/***/ }),

/***/ "./src/modules/loadMore.js":
/*!*********************************!*\
  !*** ./src/modules/loadMore.js ***!
  \*********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);


class LoadMore {
  constructor() {
    this.events();
  }

  events() {
    jquery__WEBPACK_IMPORTED_MODULE_0___default()('.suggested-friends').on('click', '#loadButton', this.loadMoreUsers.bind(this));
  }

  loadMoreUsers() {
    let currentFriends = []; //Add Spinner

    jquery__WEBPACK_IMPORTED_MODULE_0___default()('#loadButton .loadButton--add').addClass('d-none');
    jquery__WEBPACK_IMPORTED_MODULE_0___default()('#loadButton .loadButton--load').removeClass('d-none');
    jquery__WEBPACK_IMPORTED_MODULE_0___default()('#sugFriends .sugFriendsItem').each((i, obj) => {
      currentFriends.push(Number(obj.dataset.id));
    });
    jquery__WEBPACK_IMPORTED_MODULE_0___default().ajax({
      beforeSend: xhr => {
        xhr.setRequestHeader('X-WP-Nonce', friendmeData.nonce);
      },
      url: `${friendmeData.root_url}/wp-json/friendme/v1/friends/newFriends`,
      type: 'GET',
      success: res => {
        console.log('Success');
        console.log(res);
        let newFriends = res.filter(user => !currentFriends.includes(user.id));
        this.addUsers(newFriends, 2); //Remove Spinner

        jquery__WEBPACK_IMPORTED_MODULE_0___default()('#loadButton .loadButton--add').removeClass('d-none');
        jquery__WEBPACK_IMPORTED_MODULE_0___default()('#loadButton .loadButton--load').addClass('d-none');
      },
      error: res => {
        console.log('Error');
        console.log(res);
      }
    });
  }

  addUsers(friends, count) {
    let step = 0;
    friends.map(friend => {
      if (step >= count) {
        return;
      }

      step++;
      console.log(friend);
      jquery__WEBPACK_IMPORTED_MODULE_0___default()('.sugFriends__list').append(`
            <a class="sugFriendsItem list-group-item list-group-item-action" data-id="${friend.id}">
                        <h6 class="d-inline-block">${friend.full_name}</h6>
                        <br>
                        <p class="d-inline-block">${friend.name}</p>
                        <div class="add-friends__button-block d-block ms-auto ">
                            <button type="button" class="addFriendsButton d-inline-block btn btn-outline-dark text-end btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add Friend</button>
                        </div>
            </a>
            `);
    });
  }

}

/* harmony default export */ __webpack_exports__["default"] = (LoadMore);

/***/ }),

/***/ "jquery":
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/***/ (function(module) {

module.exports = window["jQuery"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
!function() {
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _modules_loadMore__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/loadMore */ "./src/modules/loadMore.js");
/* harmony import */ var _modules_friends__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/friends */ "./src/modules/friends.js");

 // Instantiate a new object using our modules/classes

const loadMore = new _modules_loadMore__WEBPACK_IMPORTED_MODULE_0__["default"]();
const friends = new _modules_friends__WEBPACK_IMPORTED_MODULE_1__["default"]();
}();
/******/ })()
;
//# sourceMappingURL=index.js.map