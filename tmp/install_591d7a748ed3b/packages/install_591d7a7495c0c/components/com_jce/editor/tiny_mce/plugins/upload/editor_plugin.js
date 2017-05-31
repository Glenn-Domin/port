/* jce - 2.6.12 | 2017-04-27 | http://www.joomlacontenteditor.net | Copyright (C) 2006 - 2017 Ryan Demmer. All rights reserved | GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html */
!function(){function uid(){var i,guid=(new Date).getTime().toString(32);for(i=0;i<5;i++)guid+=Math.floor(65535*Math.random()).toString(32);return"wf_"+guid+(counter++).toString(32)}var each=tinymce.each,extend=tinymce.extend,JSON=tinymce.util.JSON,RangeUtils=(navigator.platform.indexOf("Win")!==-1,tinymce.isWebKit&&navigator.vendor.indexOf("Apple")!==-1,tinymce.html.Node,tinymce.dom.RangeUtils),counter=0,supportDragDrop=!!(window.ProgressEvent&&window.FileReader&&window.FormData)&&!tinymce.isOpera,mimes={};!function(mime_data){var i,y,ext,items=mime_data.split(/,/);for(i=0;i<items.length;i+=2)for(ext=items[i+1].split(/ /),y=0;y<ext.length;y++)mimes[ext[y]]=items[i]}("application/msword,doc dot,application/pdf,pdf,application/pgp-signature,pgp,application/postscript,ps ai eps,application/rtf,rtf,application/vnd.ms-excel,xls xlb,application/vnd.ms-powerpoint,ppt pps pot,application/zip,zip,application/x-shockwave-flash,swf swfl,application/vnd.openxmlformats-officedocument.wordprocessingml.document,docx,application/vnd.openxmlformats-officedocument.wordprocessingml.template,dotx,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,xlsx,application/vnd.openxmlformats-officedocument.presentationml.presentation,pptx,application/vnd.openxmlformats-officedocument.presentationml.template,potx,application/vnd.openxmlformats-officedocument.presentationml.slideshow,ppsx,application/x-javascript,js,application/json,json,audio/mpeg,mpga mpega mp2 mp3,audio/x-wav,wav,audio/mp4,m4a,image/bmp,bmp,image/gif,gif,image/jpeg,jpeg jpg jpe,image/photoshop,psd,image/png,png,image/svg+xml,svg svgz,image/tiff,tiff tif,text/plain,asc txt text diff log,text/html,htm html xhtml,text/css,css,text/csv,csv,text/rtf,rtf,video/mpeg,mpeg mpg mpe,video/quicktime,qt mov,video/mp4,mp4,video/x-m4v,m4v,video/x-flv,flv,video/x-ms-wmv,wmv,video/avi,avi,video/webm,webm,video/vnd.rn-realvideo,rv,application/vnd.oasis.opendocument.formula-template,otf,application/octet-stream,exe");var state={STOPPED:1,STARTED:2,QUEUED:1,UPLOADING:2,FAILED:4,DONE:5,GENERIC_ERROR:-100,HTTP_ERROR:-200,IO_ERROR:-300,SECURITY_ERROR:-400};tinymce.create("tinymce.plugins.Upload",{files:[],plugins:[],init:function(ed,url){function cancel(){ed.dom.bind(ed.getBody(),"dragover",function(e){var dataTransfer=e.dataTransfer;dataTransfer&&dataTransfer.files&&dataTransfer.files.length&&e.preventDefault()}),ed.dom.bind(ed.getBody(),"drop",function(e){var dataTransfer=e.dataTransfer;dataTransfer&&dataTransfer.files&&dataTransfer.files.length&&e.preventDefault()})}var self=this;self.editor=ed,self.plugin_url=url,ed.onPreInit.add(function(){each(ed.plugins,function(o,k){ed.getParam(k+"_upload")&&tinymce.is(o.getUploadURL,"function")&&tinymce.is(o.insertUploadedFile,"function")&&self.plugins.push(o)}),ed.settings.compress.css||ed.dom.loadCSS(url+"/css/content.css"),ed.parser.addNodeFilter("img",function(nodes){for(var node,cls,data,i=nodes.length;i--;)node=nodes[i],cls=node.attr("class"),data=node.attr("data-mce-upload-marker"),(cls&&cls.indexOf("upload-placeholder")!=-1||data)&&(0==self.plugins.length?node.remove():self._createUploadMarker(node))}),ed.serializer.addNodeFilter("img",function(nodes){for(var node,cls,i=nodes.length;i--;)node=nodes[i],cls=node.attr("class"),cls&&/mceItemUploadMarker/.test(cls)&&(cls=cls.replace(/(?:^|\s)mceItem(Upload|UploadMarker)(?!\S)/g,""),cls+=" upload-placeholder",node.attr({"data-mce-src":"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7",class:tinymce.trim(cls)}))})}),ed.onInit.add(function(){function bindUploadEvents(ed){each(ed.dom.select("img.mceItemUploadMarker",ed.getBody()),function(n){0==self.plugins.length?ed.dom.remove(n):self._bindUploadMarkerEvents(ed,n)})}function cancelEvent(e){e.preventDefault(),e.stopPropagation()}return supportDragDrop?0==self.plugins.length?void cancel():(ed.selection.onSetContent.add(function(){bindUploadEvents(ed)}),ed.onSetContent.add(function(){bindUploadEvents(ed)}),ed.onFullScreen&&ed.onFullScreen.add(function(editor){bindUploadEvents(editor)}),ed.dom.bind(ed.getBody(),"dragover",function(e){e.dataTransfer.dropEffect=tinymce.VK.metaKeyPressed(e)?"copy":"move"}),void ed.dom.bind(ed.getBody(),"drop",function(e){var dataTransfer=e.dataTransfer;dataTransfer&&dataTransfer.files&&dataTransfer.files.length&&(each(dataTransfer.files,function(file){var rng=RangeUtils.getCaretRangeFromPoint(e.clientX,e.clientY,ed.getDoc());rng&&(ed.selection.setRng(rng),rng=null),self.addFile(file)}),cancelEvent(e)),self.files.length&&each(self.files,function(file){self.upload(file)}),tinymce.isGecko&&"IMG"==e.target.nodeName&&cancelEvent(e)})):void cancel()}),self.FilesAdded=new tinymce.util.Dispatcher(this),self.UploadProgress=new tinymce.util.Dispatcher(this),self.FileUploaded=new tinymce.util.Dispatcher(this),self.UploadError=new tinymce.util.Dispatcher(this),this.settings={multipart:!0,multi_selection:!0,file_data_name:"file",filters:[]},self.FileUploaded.add(function(file,o){function showError(error){return ed.windowManager.alert(error||ed.getLang("upload.response_error","Invalid Upload Response")),ed.dom.remove(n),!1}var s,n=file.marker;if(n){if(!o||!o.response)return showError();var r,data=o.response;try{r=JSON.parse(data)}catch(e){return data.indexOf("{")!==-1&&(data="The server returned an invalid JSON response."),showError()}if(!r||!r.result)return showError();if(r.error){var txt=r.text||r.error;return ed.windowManager.alert(txt),ed.dom.remove(n),!1}if(file.status==state.DONE){if(file.uploader){var u=file.uploader,obj={type:file.type,file:r.result.file,name:file.name};if(s=u.insertUploadedFile(obj)){var styles=ed.dom.getAttrib(n,"data-mce-style");if(styles&&(styles=ed.dom.styles.parse(styles),ed.dom.setStyles(s,styles)),ed.dom.hasClass(n,"mceItemUploadMarker")&&ed.dom.setAttribs(s,{width:n.width||s.width,height:n.height||s.height}),ed.dom.replace(s,n))return ed.nodeChanged(),!0}}self.files.splice(tinymce.inArray(self.files,file),1)}ed.dom.remove(n)}}),self.UploadError.add(function(o){ed.windowManager.alert(o.code+" : "+o.message),o.file&&o.file.marker&&ed.dom.remove(o.file.marker)})},_bindUploadMarkerEvents:function(ed,marker){function removeUpload(){dom.setStyles("wf_upload_button",{top:"",left:"",display:"none",zIndex:""})}var self=this,dom=tinymce.DOM;ed.onNodeChange.add(removeUpload),ed.dom.bind(ed.getWin(),"scroll",removeUpload);var input=dom.get("wf_upload_input");if(!input){var btn=dom.add(dom.doc.body,"div",{id:"wf_upload_button",title:ed.getLang("upload.button_description","Click to upload a file")},'<label for="wf_upload_input">'+ed.getLang("upload.label","Upload")+"</label>");input=dom.add(btn,"input",{type:"file",id:"wf_upload_input"})}ed.dom.bind(marker,"mouseover",function(e){if(!ed.dom.getAttrib(marker,"data-mce-selected")){var vp=ed.dom.getViewPort(ed.getWin()),p1=dom.getRect(ed.getContentAreaContainer()),p2=ed.dom.getRect(marker);if(!(vp.y>p2.y+p2.h/2-25||vp.y<p2.y+p2.h/2+25-p1.h)){var x=Math.max(p2.x-vp.x,0)+p1.x,y=Math.max(p2.y-vp.y,0)+p1.y-Math.max(vp.y-p2.y,0),zIndex="mce_fullscreen"==ed.id?dom.get("mce_fullscreen_container").style.zIndex:0;dom.setStyles("wf_upload_button",{top:y+p2.h/2-27,left:x+p2.w/2-54,display:"block",zIndex:zIndex+1}),input.onchange=function(){if(input.files){var file=input.files[0];file&&(file.marker=marker,self.addFile(file)&&(ed.dom.addClass(marker,"loading"),self.upload(file),removeUpload()))}}}}}),ed.dom.bind(marker,"mouseout",function(e){!e.relatedTarget&&e.clientY>0||removeUpload()})},_createUploadMarker:function(n){var styles,ed=this.editor,src=n.attr("src")||"",style={},cls=[];if(!n.attr("alt")&&!/data:image/.test(src)){var alt=src.substring(src.length,src.lastIndexOf("/")+1);n.attr("alt",alt)}n.attr("style")&&(style=ed.dom.styles.parse(n.attr("style"))),n.attr("hspace")&&(style["margin-left"]=style["margin-right"]=n.attr("hspace")),n.attr("vspace")&&(style["margin-top"]=style["margin-bottom"]=n.attr("vspace")),n.attr("align")&&(style.float=n.attr("align")),n.attr("class")&&(cls=n.attr("class").replace(/\s*upload-placeholder\s*/,"").split(" ")),cls.push("mceItemUpload"),cls.push("mceItemUploadMarker"),n.attr({src:"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7",class:tinymce.trim(cls.join(" "))});var tmp=ed.dom.create("span",{style:style});(styles=ed.dom.getAttrib(tmp,"style"))&&n.attr({style:styles,"data-mce-style":styles})},buildUrl:function(url,items){var query="";return each(items,function(value,name){query+=(query?"&":"")+encodeURIComponent(name)+"="+encodeURIComponent(value)}),query&&(url+=(url.indexOf("?")>0?"&":"?")+query),url},addFile:function(file){var url,ed=this.editor,self=this;if(/\.(php|php(3|4|5)|phtml|pl|py|jsp|asp|htm|html|shtml|sh|cgi)\./i.test(file.name))return ed.windowManager.alert(ed.getLang("upload.file_extension_error","File type not supported")),!1;if(each(self.plugins,function(o,k){file.upload_url||(url=o.getUploadURL(file))&&(file.upload_url=url,file.uploader=o)}),file.upload_url){if(tinymce.is(file.uploader.getUploadConfig,"function")){var config=file.uploader.getUploadConfig();if(!new RegExp(".("+config.filetypes.join("|")+")$","i").test(file.name))return ed.windowManager.alert(ed.getLang("upload.file_extension_error","File type not supported")),!1;if(file.size){var max=parseInt(config.max_size)||1024;if(file.size>1024*max)return ed.windowManager.alert(ed.getLang("upload.file_size_error","File size exceeds maximum allowed size")),!1}}if(self.FilesAdded.dispatch(file),!file.marker){var w=300,h=300;ed.execCommand("mceInsertContent",!1,'<img id="__mce_tmp" class="mceItemUpload" />',{skip_undo:1}),/image\/(gif|png|jpeg|jpg)/.test(file.type)&&(w=h=Math.round(Math.sqrt(file.size)),w=Math.max(100,w),h=Math.max(100,h));var n=ed.dom.get("__mce_tmp");ed.dom.setAttrib(n,"id",""),n.style.width=w+"px",n.style.height=h+"px",file.marker=n}return ed.undoManager.add(),self.files.push(file),!0}return ed.windowManager.alert(ed.getLang("upload.file_extension_error","File type not supported")),!1},upload:function(file){function sendFile(bin){var xhr=new XMLHttpRequest,formData=new FormData;xhr.upload&&(xhr.upload.onprogress=function(e){e.lengthComputable&&(file.loaded=Math.min(file.size,e.loaded),self.UploadProgress.dispatch(file))}),xhr.onreadystatechange=function(){var httpStatus;if(4==xhr.readyState&&self.state!==state.STOPPED){try{httpStatus=xhr.status}catch(ex){httpStatus=0}httpStatus>=400?self.UploadError.dispatch({code:state.HTTP_ERROR,message:ed.getLang("upload.http_error","HTTP Error"),file:file,status:httpStatus}):(file.loaded=file.size,self.UploadProgress.dispatch(file),bin=formData=null,file.status=state.DONE,self.FileUploaded.dispatch(file,{response:xhr.responseText,status:httpStatus}))}};var name=file.target_name||file.name;name=name.replace(/[\+\\\/\?\#%&<>"\'=\[\]\{\},;@\^\(\)£€$]/g,""),extend(args,{name:name}),xhr.open("post",url,!0),each(self.settings.headers,function(value,name){xhr.setRequestHeader(name,value)}),each(extend(args,self.settings.multipart_params),function(value,name){formData.append(name,value)}),formData.append(self.settings.file_data_name,bin),xhr.send(formData)}var self=this,ed=this.editor,args={method:"upload",id:uid(),inline:1,component_id:ed.settings.component_id};args[ed.settings.token]="1";var url=file.upload_url;file.status!=state.DONE&&file.status!=state.FAILED&&self.state!=state.STOPPED&&(extend(args,{name:file.target_name||file.name}),sendFile(file))},getInfo:function(){return{longname:"Drag & Drop and Placeholder Upload",author:"Ryan Demmer",authorurl:"http://www.joomlacontenteditor.net",infourl:"http://www.joomlacontenteditor.net",version:"@@version@@"}}}),tinymce.PluginManager.add("upload",tinymce.plugins.Upload)}();