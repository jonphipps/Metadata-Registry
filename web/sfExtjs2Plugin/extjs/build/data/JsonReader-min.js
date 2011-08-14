/*
 * Ext JS Library 2.0.1
 * Copyright(c) 2006-2007, Ext JS, LLC.
 * licensing@extjs.com
 * 
 * http://extjs.com/license
 */

Ext.data.JsonReader=function(A,B){A=A||{};Ext.data.JsonReader.superclass.constructor.call(this,A,B||A.fields)};Ext.extend(Ext.data.JsonReader,Ext.data.DataReader,{read:function(response){var json=response.responseText;var o=eval("("+json+")");if(!o){throw {message:"JsonReader.read: Json object not found"}}if(o.metaData){delete this.ef;this.meta=o.metaData;this.recordType=Ext.data.Record.create(o.metaData.fields);this.onMetaChange(this.meta,this.recordType,o)}return this.readRecords(o)},onMetaChange:function(A,C,B){},simpleAccess:function(B,A){return B[A]},getJsonAccessor:function(){var A=/[\[\.]/;return function(C){try{return(A.test(C))?new Function("obj","return obj."+C):function(D){return D[C]}}catch(B){}return Ext.emptyFn}}(),readRecords:function(K){this.jsonData=K;var H=this.meta,A=this.recordType,R=A.prototype.fields,F=R.items,E=R.length;if(!this.ef){if(H.totalProperty){this.getTotal=this.getJsonAccessor(H.totalProperty)}if(H.successProperty){this.getSuccess=this.getJsonAccessor(H.successProperty)}this.getRoot=H.root?this.getJsonAccessor(H.root):function(U){return U};if(H.id){var Q=this.getJsonAccessor(H.id);this.getId=function(V){var U=Q(V);return(U===undefined||U==="")?null:U}}else{this.getId=function(){return null}}this.ef=[];for(var O=0;O<E;O++){R=F[O];var T=(R.mapping!==undefined&&R.mapping!==null)?R.mapping:R.name;this.ef[O]=this.getJsonAccessor(T)}}var M=this.getRoot(K),S=M.length,I=S,D=true;if(H.totalProperty){var G=parseInt(this.getTotal(K),10);if(!isNaN(G)){I=G}}if(H.successProperty){var G=this.getSuccess(K);if(G===false||G==="false"){D=false}}var P=[];for(var O=0;O<S;O++){var L=M[O];var B={};var J=this.getId(L);for(var N=0;N<E;N++){R=F[N];var G=this.ef[N](L);B[R.name]=R.convert((G!==undefined)?G:R.defaultValue)}var C=new A(B,J);C.json=L;P[O]=C}return{success:D,records:P,totalRecords:I}}});