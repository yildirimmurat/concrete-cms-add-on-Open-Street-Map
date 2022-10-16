"use strict";var _htmlElements,_settings,_states,Events,ELEMENT_TYPE,POSITION,NAME,__classPrivateFieldGet=function(t,e){if(!e.has(t))throw new TypeError("attempted to get private field on non-instance");return e.get(t)};!function(t){t.LOAD="load"}(Events||(Events={})),function(t){t.DIV="div",t.I="i"}(ELEMENT_TYPE||(ELEMENT_TYPE={})),function(t){t.BOTTOM="bottom",t.CENTER="center"}(POSITION||(POSITION={})),function(t){t.MAP="Map"}(NAME||(NAME={}));class Mapbox{constructor(t,e,s,i,a,l,n,_,r,o){_htmlElements.set(this,{container:null,loader:null,map:null}),_settings.set(this,{ids:{container:"#map-wrapper"},classes:{loader:".loader-wrapper .loader",map:".map"},accessToken:"",markerIcon:"icon icon-icon-marker",zoomLevel:16,latitude:47.03726,longitude:9.07513,markerClass:"marker",mapStyle:"mapbox://styles/mapbox/light-v10"}),_states.set(this,{mapBoxMap:null}),__classPrivateFieldGet(this,_settings).ids.container=t,__classPrivateFieldGet(this,_settings).classes.loader=e,__classPrivateFieldGet(this,_settings).classes.map=s,__classPrivateFieldGet(this,_settings).accessToken=i,__classPrivateFieldGet(this,_settings).markerIcon=a,__classPrivateFieldGet(this,_settings).zoomLevel=l,__classPrivateFieldGet(this,_settings).latitude=n,__classPrivateFieldGet(this,_settings).longitude=_,__classPrivateFieldGet(this,_settings).markerClass=r,__classPrivateFieldGet(this,_settings).mapStyle=o,__classPrivateFieldGet(this,_htmlElements).container=document.querySelector(__classPrivateFieldGet(this,_settings).ids.container),__classPrivateFieldGet(this,_htmlElements).container&&(this.initHtmlElements(),this.initEvent(),this.initMap())}initHtmlElements(){var t,e;__classPrivateFieldGet(this,_htmlElements).loader=null===(t=__classPrivateFieldGet(this,_htmlElements).container)||void 0===t?void 0:t.querySelector(__classPrivateFieldGet(this,_settings).classes.loader),__classPrivateFieldGet(this,_htmlElements).map=null===(e=__classPrivateFieldGet(this,_htmlElements).container)||void 0===e?void 0:e.querySelector(__classPrivateFieldGet(this,_settings).classes.map)}initEvent(){}initMap(){var t=this;mapboxgl.accessToken=__classPrivateFieldGet(this,_settings).accessToken,__classPrivateFieldGet(this,_states).mapBoxMap=new mapboxgl.Map({container:__classPrivateFieldGet(this,_htmlElements).map,style:__classPrivateFieldGet(this,_settings).mapStyle,center:[__classPrivateFieldGet(this,_settings).longitude,__classPrivateFieldGet(this,_settings).latitude],zoom:__classPrivateFieldGet(this,_settings).zoomLevel}),__classPrivateFieldGet(this,_states).mapBoxMap.addControl(new mapboxgl.NavigationControl),__classPrivateFieldGet(this,_states).mapBoxMap.scrollZoom.disable(),__classPrivateFieldGet(this,_states).mapBoxMap.on(Events.LOAD,(function(){__classPrivateFieldGet(t,_states).mapBoxMap.loaded()&&(t.loadPlace(),__classPrivateFieldGet(t,_states).mapBoxMap.flyTo({center:[__classPrivateFieldGet(t,_settings).longitude,__classPrivateFieldGet(t,_settings).latitude]}),__classPrivateFieldGet(t,_states).mapBoxMap.off(Events.LOAD))}))}loadPlace(){const t=document.createElement(ELEMENT_TYPE.DIV);t.classList.add(__classPrivateFieldGet(this,_settings).markerClass);const e=document.createElement(ELEMENT_TYPE.I);__classPrivateFieldGet(this,_settings).markerIcon.split(" ").forEach((function(t){e.classList.add(t)})),t.appendChild(e),new mapboxgl.Marker({element:t,anchor:POSITION.CENTER}).setLngLat([__classPrivateFieldGet(this,_settings).longitude,__classPrivateFieldGet(this,_settings).latitude]).addTo(__classPrivateFieldGet(this,_states).mapBoxMap)}}_htmlElements=new WeakMap,_settings=new WeakMap,_states=new WeakMap;