	/************************************************************************************************************
	(C) www.dhtmlgoodies.com, October 2005
	
	This is a script from www.dhtmlgoodies.com. You will find this and a lot of other scripts at our website.	
	
	Terms of use:
	You are free to use this script as long as the copyright message is kept intact. However, you may not
	redistribute, sell or repost it without our permission.
	
	Updated:
		
		March, 14th, 2006 - Create new tabs dynamically
		March, 15th, 2006 - Dynamically delete a tab
		
	Thank you!
	
	www.dhtmlgoodies.com
	Alf Magne Kalleland
	
	************************************************************************************************************/		
	var textPadding = 3; // Padding at the left of tab text - bigger value gives you wider tabs
	var strictDocType = true; 
	var tabView_maxNumberOfTabs = 6;	// Maximum number of tabs
	
	/* Don't change anything below here */
	var dhtmlgoodies_tabObj;
	var activeTabIndex = -1;
	var MSIE = navigator.userAgent.indexOf('MSIE')>=0?true:false;
	var navigatorVersion = navigator.appVersion.replace(/.*?MSIE (\d\.\d).*/g,'$1')/1;
	var ajaxObjects = new Array();
	var tabView_countTabs = 0;
	var tabViewHeight;
	
	function setPadding(obj,padding){
		var span = obj.getElementsByTagName('SPAN')[0];
		span.style.paddingLeft = padding + 'px';	
		span.style.paddingRight = padding + 'px';	
	}
	function showTab(tabIndex)
	{
		if(!document.getElementById('tabView' + tabIndex))return;
		if(activeTabIndex>=0){
			if(activeTabIndex==tabIndex)return;
			var obj = document.getElementById('tabTab'+activeTabIndex);
			obj.className='tabInactive';
			var img = obj.getElementsByTagName('IMG')[0];
			img.src = 'images/tab_right_inactive.gif';
			document.getElementById('tabView' + activeTabIndex).style.display='none';
		}
		
		var thisObj = document.getElementById('tabTab'+tabIndex);		
		thisObj.className='tabActive';
		var img = thisObj.getElementsByTagName('IMG')[0];
		img.src = 'images/tab_right_active.gif';
		
		document.getElementById('tabView' + tabIndex).style.display='block';
		activeTabIndex = tabIndex;
		

		var parentObj = thisObj.parentNode;
		var aTab = parentObj.getElementsByTagName('DIV')[0];
		countObjects = 0;
		var startPos = 2;
		var previousObjectActive = false;
		while(aTab){
			if(aTab.tagName=='DIV'){
				if(previousObjectActive){
					previousObjectActive = false;
					startPos-=2;
				}
				if(aTab==thisObj){
					startPos-=2;
					previousObjectActive=true;
					setPadding(aTab,textPadding+1);
				}else{
					setPadding(aTab,textPadding);
				}
				
				aTab.style.left = startPos + 'px';
				countObjects++;
				startPos+=2;
			}			
			aTab = aTab.nextSibling;
		}
		
		return;
	}
	
	function tabClick()
	{
		showTab(this.id.replace(/[^\d]/g,''));
		
	}
	
	function rolloverTab()
	{
		if(this.className.indexOf('tabInactive')>=0){
			this.className='inactiveTabOver';
			var img = this.getElementsByTagName('IMG')[0];
			img.src = 'images/tab_right_over.gif';
		}
		
	}
	function rolloutTab()
	{
		if(this.className ==  'inactiveTabOver'){
			this.className='tabInactive';
			var img = this.getElementsByTagName('IMG')[0];
			img.src = 'images/tab_right_inactive.gif';
		}
		
	}
	
	function initTabs(tabTitles,activeTab,width,height,additionalTab)
	{
		if(!additionalTab || additionalTab=='undefined'){			
			dhtmlgoodies_tabObj = document.getElementById('dhtmlgoodies_tabView');
			width = width + '';
			if(width.indexOf('%')<0)width= width + 'px';
			dhtmlgoodies_tabObj.style.width = width;
						
			height = height + '';
			if(height.length>0){
				if(height.indexOf('%')<0)height= height + 'px';
				dhtmlgoodies_tabObj.style.height = height;
			}
			

			tabViewHeight = height;
			
			var tabDiv = document.createElement('DIV');		
			var firstDiv = dhtmlgoodies_tabObj.getElementsByTagName('DIV')[0];	
			
			dhtmlgoodies_tabObj.insertBefore(tabDiv,firstDiv);	
			tabDiv.className = 'dhtmlgoodies_tabPane';
			
			tabView_countTabs = 0;
		}else{
			var tabDiv = dhtmlgoodies_tabObj.getElementsByTagName('DIV')[0];
			var firstDiv = dhtmlgoodies_tabObj.getElementsByTagName('DIV')[1];
			height = tabViewHeight;
			activeTab = tabView_countTabs;			
		}
		
		
		
		for(var no=0;no<tabTitles.length;no++){
			var aTab = document.createElement('DIV');
			aTab.id = 'tabTab' + (no + tabView_countTabs);
			aTab.onmouseover = rolloverTab;
			aTab.onmouseout = rolloutTab;
			aTab.onclick = tabClick;
			aTab.className='tabInactive';
			tabDiv.appendChild(aTab);
			var span = document.createElement('SPAN');
			span.innerHTML = tabTitles[no];
			aTab.appendChild(span);
			
			var img = document.createElement('IMG');
			img.valign = 'bottom';
			img.src = 'images/tab_right_inactive.gif';
			// IE5.X FIX
			if((navigatorVersion && navigatorVersion<6) || (MSIE && !strictDocType)){
				img.style.styleFloat = 'none';
				img.style.position = 'relative';	
				img.style.top = '4px'
				span.style.paddingTop = '4px';
				aTab.style.cursor = 'hand';
			}	// End IE5.x FIX
			aTab.appendChild(img);
		}

		var tabs = dhtmlgoodies_tabObj.getElementsByTagName('DIV');
		var divCounter = 0;
		for(var no=0;no<tabs.length;no++){
			if(tabs[no].className=='dhtmlgoodies_aTab'){
				if(height.length>0)tabs[no].style.height = height;
				tabs[no].style.display='none';
				tabs[no].id = 'tabView' + divCounter;
				divCounter++;
			}			
		}	
		tabView_countTabs = tabView_countTabs + tabTitles.length;	
		showTab(activeTab);
		
		return activeTab;
	}	
	
	function showAjaxTabContent(ajaxIndex,tabId)
	{
		document.getElementById('tabView'+tabId).innerHTML = ajaxObjects[ajaxIndex].response;		
	}
	
	function resetTabIds()
	{
		var divs = dhtmlgoodies_tabObj.getElementsByTagName('DIV');
		var tabTitleCounter = 0;
		var tabContentCounter = 0;
		
		for(var no=0;no<divs.length;no++){
			if(divs[no].className=='dhtmlgoodies_aTab'){
				divs[no].id = 'tabView' + tabTitleCounter;
				tabTitleCounter++;
			}
			if(divs[no].id.indexOf('tabTab')>=0){
				divs[no].id = 'tabTab' + tabContentCounter;	
				tabContentCounter++;
			}	
			
				
		}
		
		tabView_countTabs = tabContentCounter;
	}
	
	
	function createNewTab(tabTitle,tabContent,tabContentUrl)
	{
		if(tabView_countTabs>=tabView_maxNumberOfTabs)return;	// Maximum number of tabs reached - return
		var div = document.createElement('DIV');
		div.className = 'dhtmlgoodies_aTab';
		dhtmlgoodies_tabObj.appendChild(div);		
		var tabId = initTabs(Array(tabTitle),0,'','',true);
		if(tabContent)div.innerHTML = tabContent;
		if(tabContentUrl){
		
			var ajaxIndex = ajaxObjects.length;
			ajaxObjects[ajaxIndex] = new sack();
			ajaxObjects[ajaxIndex].requestFile = tabContentUrl;	// Specifying which file to get
			ajaxObjects[ajaxIndex].onCompletion = function(){ showAjaxTabContent(ajaxIndex,tabId); };	// Specify function that will be executed after file has been found
			ajaxObjects[ajaxIndex].runAJAX();		// Execute AJAX function	
		
		}
				
	}
	
	function getTabIndexByTitle(tabTitle)
	{
		var divs = dhtmlgoodies_tabObj.getElementsByTagName('DIV');
		for(var no=0;no<divs.length;no++){
			if(divs[no].id.indexOf('tabTab')>=0){
				var span = divs[no].getElementsByTagName('SPAN')[0];
				if(span.innerHTML == tabTitle)return divs[no].id.replace(/[^0-9]/g,'')/1;		
			}
		}
		
		return -1;
		
	}
	
	
	function deleteTab(tabLabel,tabIndex)
	{
		
		if(tabLabel){
			var index = getTabIndexByTitle(tabLabel);
			if(index>=0){
				deleteTab(false,index);
			}
			
		}else if(tabIndex>=0){
			if(document.getElementById('tabTab' + tabIndex)){
				var obj = document.getElementById('tabTab' + tabIndex);
				obj.parentNode.removeChild(obj);
				var obj2 = document.getElementById('tabView' + tabIndex);
				obj2.parentNode.removeChild(obj2);
				resetTabIds();
				activeTabIndex=-1;
				showTab(0);
			}			
		}
		

			
		
		
	}
	
	