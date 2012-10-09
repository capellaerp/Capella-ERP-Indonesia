/**
 * autoNumeric.js
 * @author: BKnothe
 * @version: 1.2.1
 *
 * Created by Robert J. Knothe on 2009-06-21. Please report any bug at http://www.decorplanit.com/plugin/
 *
 * Copyright (c) 2009 Robert J. Knothe  http://www.decorplanit.com/plugin/
 *
 * The MIT License (http://www.opensource.org/licenses/mit-license.php)
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 */
(function($){
	$.fn.autoNumeric = function(){
		return this.each(function(){
			var d = $.extend($.fn.autoNumeric.defaults); //sets defaults
			var iv = $(this); //check input value iv
			var ii = this.id; //input ID
			$(this).keypress(function (e){ // keypress function
				$.extend(d, autoCode(ii, d)); //update defaults
				var cPos = 0; //caret poistion
				var nLeft = 0; //number of characters to the left of the decimalm point
				var nRight = 0; //number of characters to the right of the decimalm point
				var iLength = 0; // length of input
				var allowed = d.aNum + d.aSign + d.aDec; //allowed input
				if (document.selection){ // IE Support to find the caret position
					this.focus ();
					var Sel = document.selection.createRange();
					var SelLength = document.selection.createRange().text.length;
					Sel.moveStart ('character', -this.value.length);
					cPos = (Sel.text.length - SelLength) * 1;
					iLength = this.value.length * 1; //decimal places to the left of the decimal point
				}
				else if (this.selectionStart || this.selectionStart == '0'){ // Firefox support  to find the caret position
					cPos = this.selectionStart * 1;
					iLength = this.value.length * 1;
				} // end caret position
				nLeft = iLength - (iLength - this.value.lastIndexOf(d.aDec)); // characters to the left of the decimal point
				if (nLeft == -1){// if no decimal point is present nLeft = iLength
					nLeft = iLength;
				}
				nRight = (iLength - this.value.lastIndexOf(d.aDec)) -1; //characters to the right of the decimal point
				if (this.value.lastIndexOf(d.aDec) == -1){ // if no decimal point nRight = 0
					nRight = 0;
				}
				if (!e){ // routine for key and character codes
					e = window.event;
				}
				var kCode = ''; //Key Code
				if (e.keyCode){ // IE
					kCode = e.keyCode;
				}
				else if (e.which){ // FF & O
					kCode = e.which;
				}
				var cCode = String.fromCharCode(kCode);	//Character code
				if ((e.ctrlKey) && (cCode =='c' || cCode =='v' || cCode =='x' || e.which == 67 || e.which == 86 || e.which == 88)){ // allows copy, cut and paste
					return;
				}
				if (kCode == 8 || e.keyCode == 37 || (e.keyCode == 39 || e.which === 0)){ // allows the left and right arrows and back sface keys to function in some browsers (FF & O)
					return;
				}
				if (allowed.indexOf(cCode) == -1){
					if (d.aDec != '.' && d.aSep != '.' && e.which === 0){ // allows the delete key to work in FF when the period charactor is not used for the decimal poin and thousand separator
						return;
					}
					else{  // checks entry for allowable characters and prevents entry
						e.preventDefault();
					}
				}
				var str = this.value;
				var chr = '';
				var cNum = 0; //the number of intergers to the left of the decimal point
				for (j = 0; j < nLeft; j++){ //counts the numeric characters to the left of the decimal point that has a numeric value
					chr = str.charAt(j);
					if (chr >= '0' && chr <= '9'){
						cNum++;
					}
				}
				if (cCode == d.aDec){ // start rules when the decimal charactor key is pressed **********************************************************************************
					if (e.which === 0){ // fix for FF when the delete key is pressed - Opera still a problem
						return;
					}
					else if (this.value.indexOf(d.aDec) != -1 || d.mDec <= 0 || cPos < this.value.length - d.mDec || cPos === 0 && this.value.charAt(0) == '-' || this.value.lastIndexOf(d.aSep) >= cPos && d.aSep !== ''){ //prevents decimal point accurcy greater then the allowed
						e.preventDefault();
					}
				}  // end rules when the decimal charactor key is pressed
				if (kCode == 45 && (cPos > 0 || this.value.indexOf('-') != -1 || d.aSign === '')){// rules for negative key press ***********************
					e.preventDefault();
				}
				if (kCode >= 48 && kCode <= 57){ // start rules for number key press **********************************************************************************
					if (this.value.indexOf('-') != -1){ // start rules for controlling a leading zero when the negative sign is present
						if (cPos === 0){ // rule to prevent numbers from being entered to the left of the negative sign
							e.preventDefault();
						}
						if (this.value.charAt(1) === '0' && this.value.length >= 2 && (cPos == 1 && kCode == 48 || cPos >= 2 && cPos <= nLeft)){// start rules for controlling the leading zero with a negative sign and the first # value is 0
							e.preventDefault();
						}
						if ((this.value.charAt(1) >= 1 && this.value.charAt(1) <= 9) && (cPos == 1 && kCode == 48)){ // start rules for controlling the leading zero with a negative sign and the first # value is greater than 0
							e.preventDefault();
						}
					}
					if (this.value.indexOf('-') == -1 && this.value.length > 0){ //rules for controlling leading zero with a positive value
						if (this.value.charAt(0) === '0' && cPos > 0 && cPos <= nLeft){
							e.preventDefault();
						}
						if (nLeft > 0 && cPos === 0 && kCode == 48){
							e.preventDefault();
						}
					}
					if (cNum >= d.mNum && cPos <= nLeft){ //checks for max numeric characters to the left of the decimal point
						e.preventDefault();
					}
					if (this.value.indexOf(d.aDec) != -1 && cPos >= (this.value.length - nRight) && nRight >= d.mDec){  // rules controls the maximum decimal places on both positive and negative values
						e.preventDefault();
					}
				} // end rules for number key press
			}); // end keypress
			$(this).keyup(function (e){ //start keyup - this will format the input
				if (e.keyCode == 37 || e.keyCode == 39 || d.aSep === ''){// allows the left and right arrows and back space keys to function in some browsers also d.aSep == '' by-passes the format function
					return;
				}
				document.getElementById(this.id).value = autoGroup(this.value, d);
			});
			$(this).change(function (){ //Opera specific function to check paste O does not reconize the paste event
				if ($.browser.opera){
					autoCheck(iv, ii, d);
				}
			});
			$(this).bind('paste', function(){setTimeout(function(){autoCheck(iv, ii, d);}, 0); }); // thanks to Josh of Digitalbuh.com
		});
	};
	$.fn.autoNumeric.defaults = {
		aNum: '0123456789', //allowed  numeric values
		aSign: '', // allowed negative sign / character
		aSep: ',', // allowed housand separator character
		aDec: '.', // allowed decimal separator character
		mNum: 9, // max number of numerical characters to the left of the decimal
		mDec: 2, // max number of decimal places
		dGroup: /(\d)((\d{3}?)+)$/, // digital grouping for the thousand separator used in Format
		rMethod: 'S' // rounding method used
	};
	function autoCode(ii, d){ // function to update the defaults settings
		var fCode = $('#'+ii).attr('alt');
		if (fCode !== ''){
			d.aSign = (fCode.charAt(0) === 'n') ? '-' : ''; //Negative allowed?
			d.mNum = (fCode.charAt(1) === '0') ? d.mNum = 15 : fCode.charAt(1) * 1; // max interger value 
			if (fCode.charAt(2) != 'c'){ // thousand seperator
				if (fCode.charAt(2) === 'a'){
					d.aSep = '\'';
				}
				else if (fCode.charAt(2) === 'p'){
					d.aSep = '.';
				}
				else if (fCode.charAt(2) === 's'){
					d.aSep = ' ';
				}
				else {
					d.aSep = '';
				}
			}
			if (fCode.charAt(3) != 3){ // digital grouping
				d.dGroup = (fCode.charAt(3) == 2) ? /(\d)((\d)(\d{2}?)+)$/ : /(\d)((\d{4}?)+)$/;
			}
			d.aDec = (fCode.charAt(4) === 'c') ? ',' : d.aDec; // decimal sepatator
			d.mDec = (fCode.charAt(5) <= '9') ? fCode.charAt(5) * 1 : document.getElementById('dp'+fCode.charAt(5)).value * 1; // decimal places
			d.rMethod = (fCode.charAt(6) !== '') ? fCode.charAt(6) : d.rMethod; // rounding method
		}
		return d;
	}
	function autoGroup(iv, d){ // places the thousand separtor
		iv = iv.split(d.aSep).join('');
		var ivSplit = iv.split(d.aDec);
		var s = ivSplit[0];
		while(d.dGroup.test(s)){
			s = s.replace(d.dGroup, '$1'+d.aSep+'$2');
		}
		if (d.mDec !== 0 && ivSplit.length > 1){
			iv = s + d.aDec + ivSplit[1];
		}
		else {
			iv = s;
		}	
		return iv;
	}
	function autoRound(iv, mDec, rMethod){ // rounding function via text
		var ivRounded = '';
		var i = 0;
		var nSign = ''; 
		iv = iv + ''; // convert to string
		if (iv.charAt(0) == '-'){ //Checks if the iv (input Value)is a negative value
			nSign = (iv * 1 === 0) ? '' : '-'; //determines if the value is zero - if zero no negative sign
			iv = iv.replace('-', ''); // removes the negative sign will be added back later if required			
		}
		var dPos = iv.lastIndexOf('.'); //decimal postion as an integer
		if (dPos === 0){// prefix with a zero if the decimal point is the first character
			iv = '0' + iv;
			dPos = 1;
		}
		if (dPos == -1 || dPos == iv.length - 1){//Has an integer been passed in?
			if (mDec > 0){
				ivRounded = (dPos == -1) ? iv + '.' : iv;
				for(i = 0; i < mDec; i++){ //pads with zero
						ivRounded += '0';
				}
				return nSign + ivRounded;
			}
			else {
				return nSign + iv;
			}
		}
		var cDec = (iv.length - 1) - dPos;//checks decimal places to determine if rounding is required
		if (cDec == mDec){
			return nSign + iv; //If true return value no rounding required
		}
		if (cDec < mDec){ //Do we already have less than the number of decimal places we want?
			ivRounded = iv; //If so, pad out with zeros
			for(i = cDec; i < mDec; i++){
				ivRounded += '0';
			}
			return nSign + ivRounded;
		}
		var rLength = dPos + mDec; //rounded length of the string after rounding 
		var tRound = iv.charAt(rLength + 1) * 1; // test round
		var ivArray = [];// new array 
		for(i = 0; i <= rLength; i++){ //populate ivArray with each digit in rLength
			ivArray[i] = iv.charAt(i);
		}
		var odd = (iv.charAt(rLength) == '.') ? (iv.charAt(rLength - 1) % 2) : (iv.charAt(rLength) % 2); 
		if ((tRound > 4 && rMethod === 'S') || //Round half up symetric
			(tRound > 4 && rMethod === 'A' && nSign === '') || //Round half up asymetric positive values
			(tRound > 5 && rMethod === 'A' && nSign == '-') || //Round half up asymetric negative values
			(tRound > 5 && rMethod === 's') || //Round half down symetric
			(tRound > 5 && rMethod === 'a' && nSign === '') || //Round half down asymetric positive values
			(tRound > 4 && rMethod === 'a' && nSign == '-') || //Round half down asymetric negative values
			(tRound > 5 && rMethod === 'B') || //Round half even "Banker's Rounding"
			(tRound == 5 && rMethod === 'B' && odd == 1) || //Round half even "Banker's Rounding"
			(tRound > 0 && rMethod === 'C' && nSign === '') || //Round to ceiling toward positive infinite
			(tRound > 0 && rMethod === 'F' && nSign == '-') || //Round to floor toward negative inifinte			
			(tRound > 0 && rMethod === 'U')){ //round up away from zero 
			for(i = (ivArray.length - 1); i >= 0; i--){ //Round up the last digit if required, and continue until no more 9's are found
				if (ivArray[i] == '.'){
					continue;
				}
				ivArray[i]++;
				if (ivArray[i] < 10){ //if i does not equal 10 no more round up required
					break;
				}
			}
		}
		for (i=0; i <= rLength; i++){ //Reconstruct the string, converting any 10's to 0's
			if (ivArray[i] == '.' || ivArray[i] < 10 || i === 0){//routine to reconstruct non '10'
				ivRounded += ivArray[i];
			}
			else { // converts 10's to 0
				ivRounded += '0';
			}
		}
		if (mDec === 0){ //If there are no decimal places, we don't need a decimal point
			ivRounded = ivRounded.replace('.', '');
		}
		return nSign + ivRounded; //return rounded value
	} 
	function autoCheck(iv, ii, d){ //test pasted value for field compliance--
		var getPaste = iv.val();
		if (getPaste.length > 25){ //maximum length of pasted value
			document.getElementById(ii).value = '';
			return;
		}
		$.extend(d, autoCode(ii, d)); //update var p with the fields settings
		var allowed = d.aNum + d.aSign + d.aDec;
		var eNeg = '';
		if (d.aSign == '-'){ //escape the negative sign
			eNeg = '\\-';
		}
		var reg = new RegExp('[^'+eNeg+d.aNum+d.aDec+']','gi'); // regular expreession constructor to delete any characters not allowed for the input field.
		var testPaste = getPaste.replace(reg,''); //deletes all characters that are not permeinted in this field
		if (testPaste.lastIndexOf('-') > 0 || testPaste.indexOf(d.aDec) != testPaste.lastIndexOf(d.aDec)){
			testPaste = '';
		} 
		var rePaste = '';
		var nNeg = 0;
		var nSign = '';
		var i = 0;
		var s = testPaste.split('');
		for (i=0; i<s.length; i++){ // for loop testing pasted value after non allowable characters have been deleted
			if (i === 0 && s[i] == '-'){ // allows negative symbol to be added if it is the first character
				nNeg = 1;
				nSign = '-';
				continue;
			}
			if (s[i] == d.aDec && s.length -1 == i){ //if the last charter is a decimal point it is dropped
				break;
			}
			if (rePaste.length === 0 && s[i] == '0' && (s[i+1] >= 0 || s[i+1] <= 9)){//controls leading zero
				continue;
			}
			else {
				rePaste = rePaste + s[i];
			}
		}
		rePaste = nSign + rePaste;
		if (rePaste.indexOf(d.aDec) == -1 && rePaste.length > (d.mNum + nNeg)){  // check to see if the maximum & minimum values have been exceeded when no decimal point is present
			rePaste = '';
		}
		if (rePaste.indexOf(d.aDec) > (d.mNum + nNeg)){  // check to see if the maximum & minimum values have been exceeded when the decimal point is present
			rePaste = '';
		}
		if (rePaste.indexOf(d.aDec) != -1 && (d.aDec != '.')){
			rePaste = rePaste.replace(d.aDec, '.');
		}	
		rePaste = autoRound(rePaste, d.mDec, d.rMethod);
		if (d.aDec != '.'){
			rePaste = rePaste.replace('.', d.aDec);
		}
		if (rePaste !== '' && d.aSep !== ''){
			rePaste = autoGroup(rePaste, d);
		}
		document.getElementById(ii).value = rePaste; //returns the pasted value after it has been checked for field consistency
	}
	$.fn.autoNumeric.Strip = function(ii){ // stripe format and convert decimal seperator to a period
		var iv = document.getElementById(ii).value;
		var d = $.extend($.fn.autoNumeric.defaults);
		$.extend(d, autoCode(ii, d));
		var eNeg = '';
		if (d.aSign == '-'){ //escape the negative sign
			eNeg = '\\-';
		}
		var reg = new RegExp('[^'+eNeg+d.aNum+d.aDec+']','gi'); // regular expreession constructor
		iv = iv.replace(reg,''); //deletes all characters that are not permitted in this field
		if (iv.indexOf(d.aDec) != -1 && (d.aDec != '.')){
			iv = iv.replace(d.aDec, '.');
		}
		if (iv * 1 === 0 && eNeg !== ''){
			iv = iv.replace('-', '');
		}
		return iv;
	};
	$.fn.autoNumeric.Format = function(ii, iv){ //  function that recieves a numeric string and formats to the target input field
		var d = $.extend($.fn.autoNumeric.defaults);
		$.extend(d, autoCode(ii, d));
		iv = autoRound(iv, d.mDec, d.rMethod);
		var nNeg = 0;
		if (iv.indexOf('-') != -1 && d.aSign === ''){ //deletes negative value
			iv = '';
		}
		else if (iv.indexOf('-') != -1 && d.aSign == '-'){
			nNeg = 1;
		}
		if (iv.indexOf('.') == -1 && iv.length > (d.mNum + nNeg)){  // check to see if the maximum & minimum values have been exceeded when no decimal point is present
			iv = '';
		}
		else if (iv.indexOf('.') > (d.mNum + nNeg)){ // check to see if the maximum & minimum values have been exceeded when a decimal point is present
			iv = '';
		}
		if (d.aDec != '.'){ //replaces the decimal point with the new sepatator
			iv = iv.replace('.', d.aDec);
		}
		return autoGroup(iv, d);
	};
})(jQuery);