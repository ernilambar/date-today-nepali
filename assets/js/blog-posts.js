function _regeneratorRuntime() {
	/*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */

	_regeneratorRuntime = function () {
		return exports;
	};

	var exports = {},
			Op = Object.prototype,
			hasOwn = Op.hasOwnProperty,
			$Symbol = "function" == typeof Symbol ? Symbol : {},
			iteratorSymbol = $Symbol.iterator || "@@iterator",
			asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator",
			toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag";

	function define(obj, key, value) {
		return Object.defineProperty(obj, key, {
			value: value,
			enumerable: !0,
			configurable: !0,
			writable: !0
		}), obj[key];
	}

	try {
		define({}, "");
	} catch (err) {
		define = function (obj, key, value) {
			return obj[key] = value;
		};
	}

	function wrap(innerFn, outerFn, self, tryLocsList) {
		var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator,
				generator = Object.create(protoGenerator.prototype),
				context = new Context(tryLocsList || []);
		return generator._invoke = function (innerFn, self, context) {
			var state = "suspendedStart";
			return function (method, arg) {
				if ("executing" === state) throw new Error("Generator is already running");

				if ("completed" === state) {
					if ("throw" === method) throw arg;
					return doneResult();
				}

				for (context.method = method, context.arg = arg;;) {
					var delegate = context.delegate;

					if (delegate) {
						var delegateResult = maybeInvokeDelegate(delegate, context);

						if (delegateResult) {
							if (delegateResult === ContinueSentinel) continue;
							return delegateResult;
						}
					}

					if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) {
						if ("suspendedStart" === state) throw state = "completed", context.arg;
						context.dispatchException(context.arg);
					} else "return" === context.method && context.abrupt("return", context.arg);
					state = "executing";
					var record = tryCatch(innerFn, self, context);

					if ("normal" === record.type) {
						if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue;
						return {
							value: record.arg,
							done: context.done
						};
					}

					"throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg);
				}
			};
		}(innerFn, self, context), generator;
	}

	function tryCatch(fn, obj, arg) {
		try {
			return {
				type: "normal",
				arg: fn.call(obj, arg)
			};
		} catch (err) {
			return {
				type: "throw",
				arg: err
			};
		}
	}

	exports.wrap = wrap;
	var ContinueSentinel = {};

	function Generator() {}

	function GeneratorFunction() {}

	function GeneratorFunctionPrototype() {}

	var IteratorPrototype = {};
	define(IteratorPrototype, iteratorSymbol, function () {
		return this;
	});
	var getProto = Object.getPrototypeOf,
			NativeIteratorPrototype = getProto && getProto(getProto(values([])));
	NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype);
	var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype);

	function defineIteratorMethods(prototype) {
		["next", "throw", "return"].forEach(function (method) {
			define(prototype, method, function (arg) {
				return this._invoke(method, arg);
			});
		});
	}

	function AsyncIterator(generator, PromiseImpl) {
		function invoke(method, arg, resolve, reject) {
			var record = tryCatch(generator[method], generator, arg);

			if ("throw" !== record.type) {
				var result = record.arg,
						value = result.value;
				return value && "object" == typeof value && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) {
					invoke("next", value, resolve, reject);
				}, function (err) {
					invoke("throw", err, resolve, reject);
				}) : PromiseImpl.resolve(value).then(function (unwrapped) {
					result.value = unwrapped, resolve(result);
				}, function (error) {
					return invoke("throw", error, resolve, reject);
				});
			}

			reject(record.arg);
		}

		var previousPromise;

		this._invoke = function (method, arg) {
			function callInvokeWithMethodAndArg() {
				return new PromiseImpl(function (resolve, reject) {
					invoke(method, arg, resolve, reject);
				});
			}

			return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg();
		};
	}

	function maybeInvokeDelegate(delegate, context) {
		var method = delegate.iterator[context.method];

		if (undefined === method) {
			if (context.delegate = null, "throw" === context.method) {
				if (delegate.iterator.return && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method)) return ContinueSentinel;
				context.method = "throw", context.arg = new TypeError("The iterator does not provide a 'throw' method");
			}

			return ContinueSentinel;
		}

		var record = tryCatch(method, delegate.iterator, context.arg);
		if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel;
		var info = record.arg;
		return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel);
	}

	function pushTryEntry(locs) {
		var entry = {
			tryLoc: locs[0]
		};
		1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry);
	}

	function resetTryEntry(entry) {
		var record = entry.completion || {};
		record.type = "normal", delete record.arg, entry.completion = record;
	}

	function Context(tryLocsList) {
		this.tryEntries = [{
			tryLoc: "root"
		}], tryLocsList.forEach(pushTryEntry, this), this.reset(!0);
	}

	function values(iterable) {
		if (iterable) {
			var iteratorMethod = iterable[iteratorSymbol];
			if (iteratorMethod) return iteratorMethod.call(iterable);
			if ("function" == typeof iterable.next) return iterable;

			if (!isNaN(iterable.length)) {
				var i = -1,
						next = function next() {
					for (; ++i < iterable.length;) if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next;

					return next.value = undefined, next.done = !0, next;
				};

				return next.next = next;
			}
		}

		return {
			next: doneResult
		};
	}

	function doneResult() {
		return {
			value: undefined,
			done: !0
		};
	}

	return GeneratorFunction.prototype = GeneratorFunctionPrototype, define(Gp, "constructor", GeneratorFunctionPrototype), define(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) {
		var ctor = "function" == typeof genFun && genFun.constructor;
		return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name));
	}, exports.mark = function (genFun) {
		return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun;
	}, exports.awrap = function (arg) {
		return {
			__await: arg
		};
	}, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () {
		return this;
	}), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) {
		void 0 === PromiseImpl && (PromiseImpl = Promise);
		var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl);
		return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) {
			return result.done ? result.value : iter.next();
		});
	}, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () {
		return this;
	}), define(Gp, "toString", function () {
		return "[object Generator]";
	}), exports.keys = function (object) {
		var keys = [];

		for (var key in object) keys.push(key);

		return keys.reverse(), function next() {
			for (; keys.length;) {
				var key = keys.pop();
				if (key in object) return next.value = key, next.done = !1, next;
			}

			return next.done = !0, next;
		};
	}, exports.values = values, Context.prototype = {
		constructor: Context,
		reset: function (skipTempReset) {
			if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined);
		},
		stop: function () {
			this.done = !0;
			var rootRecord = this.tryEntries[0].completion;
			if ("throw" === rootRecord.type) throw rootRecord.arg;
			return this.rval;
		},
		dispatchException: function (exception) {
			if (this.done) throw exception;
			var context = this;

			function handle(loc, caught) {
				return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught;
			}

			for (var i = this.tryEntries.length - 1; i >= 0; --i) {
				var entry = this.tryEntries[i],
						record = entry.completion;
				if ("root" === entry.tryLoc) return handle("end");

				if (entry.tryLoc <= this.prev) {
					var hasCatch = hasOwn.call(entry, "catchLoc"),
							hasFinally = hasOwn.call(entry, "finallyLoc");

					if (hasCatch && hasFinally) {
						if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0);
						if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc);
					} else if (hasCatch) {
						if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0);
					} else {
						if (!hasFinally) throw new Error("try statement without catch or finally");
						if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc);
					}
				}
			}
		},
		abrupt: function (type, arg) {
			for (var i = this.tryEntries.length - 1; i >= 0; --i) {
				var entry = this.tryEntries[i];

				if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) {
					var finallyEntry = entry;
					break;
				}
			}

			finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null);
			var record = finallyEntry ? finallyEntry.completion : {};
			return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record);
		},
		complete: function (record, afterLoc) {
			if ("throw" === record.type) throw record.arg;
			return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel;
		},
		finish: function (finallyLoc) {
			for (var i = this.tryEntries.length - 1; i >= 0; --i) {
				var entry = this.tryEntries[i];
				if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel;
			}
		},
		catch: function (tryLoc) {
			for (var i = this.tryEntries.length - 1; i >= 0; --i) {
				var entry = this.tryEntries[i];

				if (entry.tryLoc === tryLoc) {
					var record = entry.completion;

					if ("throw" === record.type) {
						var thrown = record.arg;
						resetTryEntry(entry);
					}

					return thrown;
				}
			}

			throw new Error("illegal catch attempt");
		},
		delegateYield: function (iterable, resultName, nextLoc) {
			return this.delegate = {
				iterator: values(iterable),
				resultName: resultName,
				nextLoc: nextLoc
			}, "next" === this.method && (this.arg = undefined), ContinueSentinel;
		}
	}, exports;
}

function _typeof(obj) {
	"@babel/helpers - typeof";

	return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) {
		return typeof obj;
	} : function (obj) {
		return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
	}, _typeof(obj);
}

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) {
	try {
		var info = gen[key](arg);
		var value = info.value;
	} catch (error) {
		reject(error);
		return;
	}

	if (info.done) {
		resolve(value);
	} else {
		Promise.resolve(value).then(_next, _throw);
	}
}

function _asyncToGenerator(fn) {
	return function () {
		var self = this,
				args = arguments;
		return new Promise(function (resolve, reject) {
			var gen = fn.apply(self, args);

			function _next(value) {
				asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value);
			}

			function _throw(err) {
				asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err);
			}

			_next(undefined);
		});
	};
}

function _classCallCheck(instance, Constructor) {
	if (!(instance instanceof Constructor)) {
		throw new TypeError("Cannot call a class as a function");
	}
}

function _defineProperties(target, props) {
	for (var i = 0; i < props.length; i++) {
		var descriptor = props[i];
		descriptor.enumerable = descriptor.enumerable || false;
		descriptor.configurable = true;
		if ("value" in descriptor) descriptor.writable = true;
		Object.defineProperty(target, descriptor.key, descriptor);
	}
}

function _createClass(Constructor, protoProps, staticProps) {
	if (protoProps) _defineProperties(Constructor.prototype, protoProps);
	if (staticProps) _defineProperties(Constructor, staticProps);
	Object.defineProperty(Constructor, "prototype", {
		writable: false
	});
	return Constructor;
}

function _inherits(subClass, superClass) {
	if (typeof superClass !== "function" && superClass !== null) {
		throw new TypeError("Super expression must either be null or a function");
	}

	subClass.prototype = Object.create(superClass && superClass.prototype, {
		constructor: {
			value: subClass,
			writable: true,
			configurable: true
		}
	});
	Object.defineProperty(subClass, "prototype", {
		writable: false
	});
	if (superClass) _setPrototypeOf(subClass, superClass);
}

function _getPrototypeOf(o) {
	_getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function _getPrototypeOf(o) {
		return o.__proto__ || Object.getPrototypeOf(o);
	};
	return _getPrototypeOf(o);
}

function _setPrototypeOf(o, p) {
	_setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function _setPrototypeOf(o, p) {
		o.__proto__ = p;
		return o;
	};
	return _setPrototypeOf(o, p);
}

function _isNativeReflectConstruct() {
	if (typeof Reflect === "undefined" || !Reflect.construct) return false;
	if (Reflect.construct.sham) return false;
	if (typeof Proxy === "function") return true;

	try {
		Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {}));
		return true;
	} catch (e) {
		return false;
	}
}

function _assertThisInitialized(self) {
	if (self === void 0) {
		throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
	}

	return self;
}

function _possibleConstructorReturn(self, call) {
	if (call && (typeof call === "object" || typeof call === "function")) {
		return call;
	} else if (call !== void 0) {
		throw new TypeError("Derived constructors may only return object or undefined");
	}

	return _assertThisInitialized(self);
}

function _createSuper(Derived) {
	var hasNativeReflectConstruct = _isNativeReflectConstruct();

	return function _createSuperInternal() {
		var Super = _getPrototypeOf(Derived),
				result;

		if (hasNativeReflectConstruct) {
			var NewTarget = _getPrototypeOf(this).constructor;

			result = Reflect.construct(Super, arguments, NewTarget);
		} else {
			result = Super.apply(this, arguments);
		}

		return _possibleConstructorReturn(this, result);
	};
}

function _slicedToArray(arr, i) {
	return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest();
}

function _toConsumableArray(arr) {
	return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread();
}

function _arrayWithoutHoles(arr) {
	if (Array.isArray(arr)) return _arrayLikeToArray(arr);
}

function _arrayWithHoles(arr) {
	if (Array.isArray(arr)) return arr;
}

function _iterableToArray(iter) {
	if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter);
}

function _iterableToArrayLimit(arr, i) {
	var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"];

	if (_i == null) return;
	var _arr = [];
	var _n = true;
	var _d = false;

	var _s, _e;

	try {
		for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) {
			_arr.push(_s.value);

			if (i && _arr.length === i) break;
		}
	} catch (err) {
		_d = true;
		_e = err;
	} finally {
		try {
			if (!_n && _i["return"] != null) _i["return"]();
		} finally {
			if (_d) throw _e;
		}
	}

	return _arr;
}

function _unsupportedIterableToArray(o, minLen) {
	if (!o) return;
	if (typeof o === "string") return _arrayLikeToArray(o, minLen);
	var n = Object.prototype.toString.call(o).slice(8, -1);
	if (n === "Object" && o.constructor) n = o.constructor.name;
	if (n === "Map" || n === "Set") return Array.from(o);
	if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen);
}

function _arrayLikeToArray(arr, len) {
	if (len == null || len > arr.length) len = arr.length;

	for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i];

	return arr2;
}

function _nonIterableSpread() {
	throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
}

function _nonIterableRest() {
	throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
}

function noop() {}

function is_promise(value) {
	return value && _typeof(value) === 'object' && typeof value.then === 'function';
}

function run(fn) {
	return fn();
}

function blank_object() {
	return Object.create(null);
}

function run_all(fns) {
	fns.forEach(run);
}

function is_function(thing) {
	return typeof thing === 'function';
}

function safe_not_equal(a, b) {
	return a != a ? b == b : a !== b || a && _typeof(a) === 'object' || typeof a === 'function';
}

function is_empty(obj) {
	return Object.keys(obj).length === 0;
}
// at the end of hydration without touching the remaining nodes.


var is_hydrating = false;

function start_hydrating() {
	is_hydrating = true;
}

function end_hydrating() {
	is_hydrating = false;
}

function upper_bound(low, high, key, value) {
	// Return first index of value larger than input value in the range [low, high)
	while (low < high) {
		var mid = low + (high - low >> 1);

		if (key(mid) <= value) {
			low = mid + 1;
		} else {
			high = mid;
		}
	}

	return low;
}

function init_hydrate(target) {
	if (target.hydrate_init) return;
	target.hydrate_init = true; // We know that all children have claim_order values since the unclaimed have been detached

	var children = target.childNodes;
	/*
	* Reorder claimed children optimally.
	* We can reorder claimed children optimally by finding the longest subsequence of
	* nodes that are already claimed in order and only moving the rest. The longest
	* subsequence subsequence of nodes that are claimed in order can be found by
	* computing the longest increasing subsequence of .claim_order values.
	*
	* This algorithm is optimal in generating the least amount of reorder operations
	* possible.
	*
	* Proof:
	* We know that, given a set of reordering operations, the nodes that do not move
	* always form an increasing subsequence, since they do not move among each other
	* meaning that they must be already ordered among each other. Thus, the maximal
	* set of nodes that do not move form a longest increasing subsequence.
	*/
	// Compute longest increasing subsequence
	// m: subsequence length j => index k of smallest value that ends an increasing subsequence of length j

	var m = new Int32Array(children.length + 1); // Predecessor indices + 1

	var p = new Int32Array(children.length);
	m[0] = -1;
	var longest = 0;

	for (var i = 0; i < children.length; i++) {
		var current = children[i].claim_order; // Find the largest subsequence length such that it ends in a value less than our current value
		// upper_bound returns first greater value, so we subtract one

		var seqLen = upper_bound(1, longest + 1, function (idx) {
			return children[m[idx]].claim_order;
		}, current) - 1;
		p[i] = m[seqLen] + 1;
		var newLen = seqLen + 1; // We can guarantee that current is the smallest value. Otherwise, we would have generated a longer sequence.

		m[newLen] = i;
		longest = Math.max(newLen, longest);
	} // The longest increasing subsequence of nodes (initially reversed)


	var lis = []; // The rest of the nodes, nodes that will be moved

	var toMove = [];
	var last = children.length - 1;

	for (var cur = m[longest] + 1; cur != 0; cur = p[cur - 1]) {
		lis.push(children[cur - 1]);

		for (; last >= cur; last--) {
			toMove.push(children[last]);
		}

		last--;
	}

	for (; last >= 0; last--) {
		toMove.push(children[last]);
	}

	lis.reverse(); // We sort the nodes being moved to guarantee that their insertion order matches the claim order

	toMove.sort(function (a, b) {
		return a.claim_order - b.claim_order;
	}); // Finally, we move the nodes

	for (var _i = 0, j = 0; _i < toMove.length; _i++) {
		while (j < lis.length && toMove[_i].claim_order >= lis[j].claim_order) {
			j++;
		}

		var anchor = j < lis.length ? lis[j] : null;
		target.insertBefore(toMove[_i], anchor);
	}
}

function append(target, node) {
	if (is_hydrating) {
		init_hydrate(target);

		if (target.actual_end_child === undefined || target.actual_end_child !== null && target.actual_end_child.parentElement !== target) {
			target.actual_end_child = target.firstChild;
		}

		if (node !== target.actual_end_child) {
			target.insertBefore(node, target.actual_end_child);
		} else {
			target.actual_end_child = node.nextSibling;
		}
	} else if (node.parentNode !== target) {
		target.appendChild(node);
	}
}

function insert(target, node, anchor) {
	if (is_hydrating && !anchor) {
		append(target, node);
	} else if (node.parentNode !== target || node.nextSibling != anchor) {
		target.insertBefore(node, anchor || null);
	}
}

function detach(node) {
	node.parentNode.removeChild(node);
}

function destroy_each(iterations, detaching) {
	for (var i = 0; i < iterations.length; i += 1) {
		if (iterations[i]) iterations[i].d(detaching);
	}
}

function element(name) {
	return document.createElement(name);
}

function text(data) {
	return document.createTextNode(data);
}

function empty() {
	return text('');
}

function attr(node, attribute, value) {
	if (value == null) node.removeAttribute(attribute);else if (node.getAttribute(attribute) !== value) node.setAttribute(attribute, value);
}

function children(element) {
	return Array.from(element.childNodes);
}

var current_component;

function set_current_component(component) {
	current_component = component;
}

function get_current_component() {
	if (!current_component) throw new Error('Function called outside component initialization');
	return current_component;
}

var dirty_components = [];
var binding_callbacks = [];
var render_callbacks = [];
var flush_callbacks = [];
var resolved_promise = Promise.resolve();
var update_scheduled = false;

function schedule_update() {
	if (!update_scheduled) {
		update_scheduled = true;
		resolved_promise.then(flush);
	}
}

function add_render_callback(fn) {
	render_callbacks.push(fn);
}

var flushing = false;
var seen_callbacks = new Set();

function flush() {
	if (flushing) return;
	flushing = true;

	do {
		// first, call beforeUpdate functions
		// and update components
		for (var i = 0; i < dirty_components.length; i += 1) {
			var component = dirty_components[i];
			set_current_component(component);
			update(component.$$);
		}

		set_current_component(null);
		dirty_components.length = 0;

		while (binding_callbacks.length) {
			binding_callbacks.pop()();
		} // then, once components are updated, call
		// afterUpdate functions. This may cause
		// subsequent updates...


		for (var _i3 = 0; _i3 < render_callbacks.length; _i3 += 1) {
			var callback = render_callbacks[_i3];

			if (!seen_callbacks.has(callback)) {
				// ...so guard against infinite loops
				seen_callbacks.add(callback);
				callback();
			}
		}

		render_callbacks.length = 0;
	} while (dirty_components.length);

	while (flush_callbacks.length) {
		flush_callbacks.pop()();
	}

	update_scheduled = false;
	flushing = false;
	seen_callbacks.clear();
}

function update($$) {
	if ($$.fragment !== null) {
		$$.update();
		run_all($$.before_update);
		var dirty = $$.dirty;
		$$.dirty = [-1];
		$$.fragment && $$.fragment.p($$.ctx, dirty);
		$$.after_update.forEach(add_render_callback);
	}
}

var outroing = new Set();
var outros;

function group_outros() {
	outros = {
		r: 0,
		c: [],
		p: outros // parent group

	};
}

function check_outros() {
	if (!outros.r) {
		run_all(outros.c);
	}

	outros = outros.p;
}

function transition_in(block, local) {
	if (block && block.i) {
		outroing["delete"](block);
		block.i(local);
	}
}

function transition_out(block, local, detach, callback) {
	if (block && block.o) {
		if (outroing.has(block)) return;
		outroing.add(block);
		outros.c.push(function () {
			outroing["delete"](block);

			if (callback) {
				if (detach) block.d(1);
				callback();
			}
		});
		block.o(local);
	}
}

function handle_promise(promise, info) {
	var token = info.token = {};

	function update(type, index, key, value) {
		if (info.token !== token) return;
		info.resolved = value;
		var child_ctx = info.ctx;

		if (key !== undefined) {
			child_ctx = child_ctx.slice();
			child_ctx[key] = value;
		}

		var block = type && (info.current = type)(child_ctx);
		var needs_flush = false;

		if (info.block) {
			if (info.blocks) {
				info.blocks.forEach(function (block, i) {
					if (i !== index && block) {
						group_outros();
						transition_out(block, 1, 1, function () {
							if (info.blocks[i] === block) {
								info.blocks[i] = null;
							}
						});
						check_outros();
					}
				});
			} else {
				info.block.d(1);
			}

			block.c();
			transition_in(block, 1);
			block.m(info.mount(), info.anchor);
			needs_flush = true;
		}

		info.block = block;
		if (info.blocks) info.blocks[index] = block;

		if (needs_flush) {
			flush();
		}
	}

	if (is_promise(promise)) {
		var _current_component = get_current_component();

		promise.then(function (value) {
			set_current_component(_current_component);
			update(info.then, 1, info.value, value);
			set_current_component(null);
		}, function (error) {
			set_current_component(_current_component);
			update(info["catch"], 2, info.error, error);
			set_current_component(null);

			if (!info.hasCatch) {
				throw error;
			}
		}); // if we previously had a then/catch block, destroy it

		if (info.current !== info.pending) {
			update(info.pending, 0);
			return true;
		}
	} else {
		if (info.current !== info.then) {
			update(info.then, 1, info.value, promise);
			return true;
		}

		info.resolved = promise;
	}
}

function update_await_block_branch(info, ctx, dirty) {
	var child_ctx = ctx.slice();
	var resolved = info.resolved;

	if (info.current === info.then) {
		child_ctx[info.value] = resolved;
	}

	if (info.current === info["catch"]) {
		child_ctx[info.error] = resolved;
	}

	info.block.p(child_ctx, dirty);
}

function mount_component(component, target, anchor, customElement) {
	var _component$$$ = component.$$,
			fragment = _component$$$.fragment,
			on_mount = _component$$$.on_mount,
			on_destroy = _component$$$.on_destroy,
			after_update = _component$$$.after_update;
	fragment && fragment.m(target, anchor);

	if (!customElement) {
		// onMount happens before the initial afterUpdate
		add_render_callback(function () {
			var new_on_destroy = on_mount.map(run).filter(is_function);

			if (on_destroy) {
				on_destroy.push.apply(on_destroy, _toConsumableArray(new_on_destroy));
			} else {
				// Edge case - component was destroyed immediately,
				// most likely as a result of a binding initialising
				run_all(new_on_destroy);
			}

			component.$$.on_mount = [];
		});
	}

	after_update.forEach(add_render_callback);
}

function destroy_component(component, detaching) {
	var $$ = component.$$;

	if ($$.fragment !== null) {
		run_all($$.on_destroy);
		$$.fragment && $$.fragment.d(detaching); // TODO null out other refs, including component.$$ (but need to
		// preserve final state?)

		$$.on_destroy = $$.fragment = null;
		$$.ctx = [];
	}
}

function make_dirty(component, i) {
	if (component.$$.dirty[0] === -1) {
		dirty_components.push(component);
		schedule_update();
		component.$$.dirty.fill(0);
	}

	component.$$.dirty[i / 31 | 0] |= 1 << i % 31;
}

function init(component, options, instance, create_fragment, not_equal, props) {
	var dirty = arguments.length > 6 && arguments[6] !== undefined ? arguments[6] : [-1];
	var parent_component = current_component;
	set_current_component(component);
	var $$ = component.$$ = {
		fragment: null,
		ctx: null,
		// state
		props: props,
		update: noop,
		not_equal: not_equal,
		bound: blank_object(),
		// lifecycle
		on_mount: [],
		on_destroy: [],
		on_disconnect: [],
		before_update: [],
		after_update: [],
		context: new Map(parent_component ? parent_component.$$.context : options.context || []),
		// everything else
		callbacks: blank_object(),
		dirty: dirty,
		skip_bound: false
	};
	var ready = false;
	$$.ctx = instance ? instance(component, options.props || {}, function (i, ret) {
		var value = (arguments.length <= 2 ? 0 : arguments.length - 2) ? arguments.length <= 2 ? undefined : arguments[2] : ret;

		if ($$.ctx && not_equal($$.ctx[i], $$.ctx[i] = value)) {
			if (!$$.skip_bound && $$.bound[i]) $$.bound[i](value);
			if (ready) make_dirty(component, i);
		}

		return ret;
	}) : [];
	$$.update();
	ready = true;
	run_all($$.before_update); // `false` as a special case of no DOM component

	$$.fragment = create_fragment ? create_fragment($$.ctx) : false;

	if (options.target) {
		if (options.hydrate) {
			start_hydrating();
			var nodes = children(options.target); // eslint-disable-next-line @typescript-eslint/no-non-null-assertion

			$$.fragment && $$.fragment.l(nodes);
			nodes.forEach(detach);
		} else {
			// eslint-disable-next-line @typescript-eslint/no-non-null-assertion
			$$.fragment && $$.fragment.c();
		}

		if (options.intro) transition_in(component.$$.fragment);
		mount_component(component, options.target, options.anchor, options.customElement);
		end_hydrating();
		flush();
	}

	set_current_component(parent_component);
}
/**
 * Base class for Svelte components. Used when dev=false.
 */


var SvelteComponent = /*#__PURE__*/function () {
	function SvelteComponent() {
		_classCallCheck(this, SvelteComponent);
	}

	_createClass(SvelteComponent, [{
		key: "$destroy",
		value: function $destroy() {
			destroy_component(this, 1);
			this.$destroy = noop;
		}
	}, {
		key: "$on",
		value: function $on(type, callback) {
			var callbacks = this.$$.callbacks[type] || (this.$$.callbacks[type] = []);
			callbacks.push(callback);
			return function () {
				var index = callbacks.indexOf(callback);
				if (index !== -1) callbacks.splice(index, 1);
			};
		}
	}, {
		key: "$set",
		value: function $set($$props) {
			if (this.$$set && !is_empty($$props)) {
				this.$$.skip_bound = true;
				this.$$set($$props);
				this.$$.skip_bound = false;
			}
		}
	}]);

	return SvelteComponent;
}();

function get_each_context(ctx, list, i) {
	var child_ctx = ctx.slice();
	child_ctx[2] = list[i];
	return child_ctx;
} // (31:0) {:catch error}


function create_catch_block(ctx) {
	var p;
	return {
		c: function c() {
			p = element("p");
			p.textContent = "An error occurred!";
		},
		m: function m(target, anchor) {
			insert(target, p, anchor);
		},
		p: noop,
		d: function d(detaching) {
			if (detaching) detach(p);
		}
	};
} // (20:0) {:then data}


function create_then_block(ctx) {
	var if_block_anchor;

	function select_block_type(ctx, dirty) {
		if (
		/*data*/
		ctx[1].success) return create_if_block;
		return create_else_block;
	}

	var current_block_type = select_block_type(ctx);
	var if_block = current_block_type(ctx);
	return {
		c: function c() {
			if_block.c();
			if_block_anchor = empty();
		},
		m: function m(target, anchor) {
			if_block.m(target, anchor);
			insert(target, if_block_anchor, anchor);
		},
		p: function p(ctx, dirty) {
			if_block.p(ctx, dirty);
		},
		d: function d(detaching) {
			if_block.d(detaching);
			if (detaching) detach(if_block_anchor);
		}
	};
} // (28:4) {:else}


function create_else_block(ctx) {
	var p;
	return {
		c: function c() {
			p = element("p");
			p.textContent = "An error occurred!";
		},
		m: function m(target, anchor) {
			insert(target, p, anchor);
		},
		p: noop,
		d: function d(detaching) {
			if (detaching) detach(p);
		}
	};
} // (22:4) {#if data.success }


function create_if_block(ctx) {
	var ul;
	var each_value =
	/*data*/
	ctx[1].data;
	var each_blocks = [];

	for (var i = 0; i < each_value.length; i += 1) {
		each_blocks[i] = create_each_block(get_each_context(ctx, each_value, i));
	}

	return {
		c: function c() {
			ul = element("ul");

			for (var _i = 0; _i < each_blocks.length; _i += 1) {
				each_blocks[_i].c();
			}
		},
		m: function m(target, anchor) {
			insert(target, ul, anchor);

			for (var _i2 = 0; _i2 < each_blocks.length; _i2 += 1) {
				each_blocks[_i2].m(ul, null);
			}
		},
		p: function p(ctx, dirty) {
			if (dirty &
			/*fetchBlogPosts*/
			1) {
				each_value =
				/*data*/
				ctx[1].data;

				var _i3;

				for (_i3 = 0; _i3 < each_value.length; _i3 += 1) {
					var child_ctx = get_each_context(ctx, each_value, _i3);

					if (each_blocks[_i3]) {
						each_blocks[_i3].p(child_ctx, dirty);
					} else {
						each_blocks[_i3] = create_each_block(child_ctx);

						each_blocks[_i3].c();

						each_blocks[_i3].m(ul, null);
					}
				}

				for (; _i3 < each_blocks.length; _i3 += 1) {
					each_blocks[_i3].d(1);
				}

				each_blocks.length = each_value.length;
			}
		},
		d: function d(detaching) {
			if (detaching) detach(ul);
			destroy_each(each_blocks, detaching);
		}
	};
} // (24:8) {#each data.data as item}


function create_each_block(ctx) {
	var li;
	var a;
	var t_value =
	/*item*/
	ctx[2].title + "";
	var t;
	return {
		c: function c() {
			li = element("li");
			a = element("a");
			t = text(t_value);
			attr(a, "href", /*item*/
			ctx[2].url);
			attr(a, "target", "_blank");
		},
		m: function m(target, anchor) {
			insert(target, li, anchor);
			append(li, a);
			append(a, t);
		},
		p: noop,
		d: function d(detaching) {
			if (detaching) detach(li);
		}
	};
} // (18:23)    <p>Loading</p> {:then data}


function create_pending_block(ctx) {
	var p;
	return {
		c: function c() {
			p = element("p");
			p.textContent = "Loading";
		},
		m: function m(target, anchor) {
			insert(target, p, anchor);
		},
		p: noop,
		d: function d(detaching) {
			if (detaching) detach(p);
		}
	};
}

function create_fragment(ctx) {
	var await_block_anchor;
	var info = {
		ctx: ctx,
		current: null,
		token: null,
		hasCatch: true,
		pending: create_pending_block,
		then: create_then_block,
		"catch": create_catch_block,
		value: 1,
		error: 5
	};
	handle_promise(/*fetchBlogPosts*/
	ctx[0], info);
	return {
		c: function c() {
			await_block_anchor = empty();
			info.block.c();
		},
		m: function m(target, anchor) {
			insert(target, await_block_anchor, anchor);
			info.block.m(target, info.anchor = anchor);

			info.mount = function () {
				return await_block_anchor.parentNode;
			};

			info.anchor = await_block_anchor;
		},
		p: function p(new_ctx, _ref) {
			var _ref2 = _slicedToArray(_ref, 1),
					dirty = _ref2[0];

			ctx = new_ctx;
			update_await_block_branch(info, ctx, dirty);
		},
		i: noop,
		o: noop,
		d: function d(detaching) {
			if (detaching) detach(await_block_anchor);
			info.block.d(detaching);
			info.token = null;
			info = null;
		}
	};
}

function instance($$self) {
	var fetchBlogPosts = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee() {
		var ajaxdata, response;
		return _regeneratorRuntime().wrap(function _callee$(_context) {
			while (1) {
				switch (_context.prev = _context.next) {
					case 0:
						ajaxdata = new FormData();
						ajaxdata.append('action', 'nsbl_get_posts');
						_context.next = 4;
						return fetch(NSBL.ajaxurl, {
							method: 'POST',
							credentials: 'same-origin',
							body: ajaxdata
						});

					case 4:
						response = _context.sent;
						_context.next = 7;
						return response.json();

					case 7:
						return _context.abrupt("return", _context.sent);

					case 8:
					case "end":
						return _context.stop();
				}
			}
		}, _callee);
	}))();

	return [fetchBlogPosts];
}

var App = /*#__PURE__*/function (_SvelteComponent) {
	_inherits(App, _SvelteComponent);

	var _super = _createSuper(App);

	function App(options) {
		var _this;

		_classCallCheck(this, App);

		_this = _super.call(this);
		init(_assertThisInitialized(_this), options, instance, create_fragment, safe_not_equal, {});
		return _this;
	}

	return _createClass(App);
}(SvelteComponent);

new App({
	target: document.getElementById('ns-blog-list')
});
//# sourceMappingURL=blog.js.map
