(function(){"use strict";var v=function(){var e=this,a=e.$createElement,t=e._self._c||a;return t("li",{staticClass:"backup-entry"},[t("div",{staticClass:"backup-filename"},[t("k-icon",{attrs:{type:"backup"}}),t("span",[e._v(e._s(e.backup.filename))])],1),t("div",{staticClass:"backup-size"},[e._v(e._s(e.backup.size))]),t("div",{staticClass:"backup-date"},[e._v(e._s(e.backup.date))]),t("div",{staticClass:"backup-actions"},[e.downloading?t("k-button",{staticClass:"backup-download",attrs:{icon:"backupsLoader",disabled:!0,size:"sm",variant:"filled"}},[e._v(e._s(e.$t("backups.downloading")))]):t("k-button",{staticClass:"backup-download",attrs:{icon:"download",size:"sm",variant:"filled"},on:{click:function(i){return e.$emit("download",e.backup.filename)}}},[e._v(e._s(e.$t("backups.download")))]),t("k-button",{staticClass:"backup-delete",attrs:{icon:"trash",theme:"negative",variant:"filled",size:"sm"},on:{click:function(i){return e.$emit("delete")}}})],1)])},f=[];function r(e,a,t,i,o,k,h,j){var s=typeof e=="function"?e.options:e;a&&(s.render=a,s.staticRenderFns=t,s._compiled=!0),i&&(s.functional=!0),k&&(s._scopeId="data-v-"+k);var l;if(h?(l=function(n){n=n||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext,!n&&typeof __VUE_SSR_CONTEXT__!="undefined"&&(n=__VUE_SSR_CONTEXT__),o&&o.call(this,n),n&&n._registeredComponents&&n._registeredComponents.add(h)},s._ssrRegister=l):o&&(l=j?function(){o.call(this,(s.functional?this.parent:this).$root.$options.shadowRoot)}:o),l)if(s.functional){s._injectStyles=l;var N=s.render;s.render=function(O,_){return l.call(_),N(O,_)}}else{var b=s.beforeCreate;s.beforeCreate=b?[].concat(b,l):[l]}return{exports:e,options:s}}const m={props:["backup","downloading"]},u={};var g=r(m,v,f,!1,$,null,null,null);function $(e){for(let a in u)this[a]=u[a]}var w=function(){return g.exports}(),C=function(){var e=this,a=e.$createElement,t=e._self._c||a;return t("k-dialog",{ref:"dialog",attrs:{size:"medium",theme:"negative",icon:"trash",button:e.$t("backups.delete.button")},on:{close:e.resetBackup,cancel:e.resetBackup,submit:e.deleteBackup}},[t("k-text",[e._v(" "+e._s(e.$t("backups.delete.prefix"))+" "),t("strong",[e._v(e._s(e.filename))])])],1)},y=[];const D={data(){return{backup:null}},computed:{filename(){return this.backup?this.backup.filename:""}},methods:{open(e){this.backup=e,this.$refs.dialog.open()},resetBackup(){this.backup=null},deleteBackup(){this.$api.post("backups/delete-backup",{filename:this.backup.filename}).then(e=>{e.deleted&&this.$emit("deleted",this.backup.filename),this.$refs.dialog.close()})}}},c={};var B=r(D,C,y,!1,S,null,null,null);function S(e){for(let a in c)this[a]=c[a]}var x=function(){return B.exports}(),z=function(){var e=this,a=e.$createElement,t=e._self._c||a;return t("k-dialog",{ref:"dialog",class:["backups-delete-dialog",{"can-delete":e.canDelete}],attrs:{button:e.$t("backups.delete.multiple.button"),theme:"negative",icon:"trash",size:"medium"},on:{submit:e.deleteBackups}},[t("k-form",{ref:"form",staticClass:"backups-delete-form",attrs:{fields:e.fields},on:{input:e.onPeriodChange},model:{value:e.value,callback:function(i){e.value=i},expression:"value"}}),e.hasWarning?t("k-box",{attrs:{theme:"info"}},[t("k-text",{domProps:{innerHTML:e._s(e.warning)}})],1):e.loadingSimulation?t("div",{staticClass:"warning-loading"},[t("k-icon",{attrs:{type:"backupsLoader"}})],1):e._e()],1)},A=[];const M={data(){return{status:"closed",warning:"",toDelete:0,value:{period:null},fields:{period:{label:this.$t("backups.delete.multiple.question"),type:"select",placeholder:this.$t("backups.delete.multiple.placeholder"),options:[{value:"week",text:this.$t("backups.delete.multiple.week")},{value:"month",text:this.$t("backups.delete.multiple.month")},{value:"half",text:this.$t("backups.delete.multiple.half")},{value:"year",text:this.$t("backups.delete.multiple.year")}]}}}},props:{backups:Object},computed:{hasWarning(){return this.status=="warning"&&this.warning.length},loadingSimulation(){return this.status=="warning"&&!this.hasWarning},canDelete(){return this.hasWarning&&this.toDelete>0}},methods:{open(){this.resetValue(),this.status="open",this.$refs.dialog.open()},onPeriodChange(){this.value.period&&this.value.period.length?this.simulate():this.status="open"},simulate(){this.status="warning",this.warning="",this.$api.get("backups/simulate-deletion",{period:this.value.period}).then(e=>{this.warning=e.toDelete.text,this.toDelete=e.toDelete.count})},deleteBackups(){this.$api.post("backups/delete-backups",{period:this.value.period}).then(e=>{this.$emit("deleted",e.deleted),this.$refs.dialog.close()})},resetValue(){this.value={period:null},this.warning=""}}},d={};var R=r(M,z,A,!1,L,null,null,null);function L(e){for(let a in d)this[a]=d[a]}var T=function(){return R.exports}(),V=function(){var e=this,a=e.$createElement,t=e._self._c||a;return t("k-inside",[t("k-view",{staticClass:"k-backups-view"},[t("k-header",{staticClass:"k-backups-view-header"},[e._v(" "+e._s(e.title)+" "),t("k-button-group",{attrs:{slot:"left"},slot:"left"},[e.creationStatus=="default"?t("k-button",{attrs:{icon:"add",variant:"filled",text:e.$t("backups.create"),size:"sm"},on:{click:e.createBackup}}):e.creationStatus=="progress"?t("k-button",{attrs:{icon:"loader",disabled:!0,variant:"filled",text:e.$t("backups.create.process"),size:"sm"}}):e.creationStatus=="success"?t("k-button",{attrs:{icon:"check",disabled:!0,theme:"positive",variant:"filled",text:e.$t("backups.create.success"),size:"sm"}}):e.creationStatus=="error"?t("k-button",{attrs:{icon:"alert",disabled:!0,theme:"negative",variant:"filled",text:e.$t("backups.create.error"),size:"sm"}}):e._e()],1),e.backups.length?t("k-button-group",{attrs:{slot:"right"},slot:"right"},[e.downloading!=="latest"?t("k-button",{attrs:{icon:"download",variant:"filled",text:e.$t("backups.download.latest"),size:"sm"},on:{click:function(i){return e.copyAndDownload("latest")}}}):t("k-button",{attrs:{icon:"loader",disabled:!0,variant:"filled",text:e.$t("backups.downloading"),size:"sm"}}),t("k-button",{attrs:{icon:"trash",variant:"filled",text:e.$t("backups.delete.some"),size:"sm"},on:{click:e.openBackupsDeleteDialog}})],1):e._e()],1),e.backups.length?t("section",{staticClass:"backups-section"},[t("header",{staticClass:"backups-header"},[t("div",{staticClass:"backup-filename"},[e._v(e._s(e.$t("backups.filename")))]),t("div",{staticClass:"backup-size"},[e._v(e._s(e.$t("backups.size")))]),t("div",{staticClass:"backup-date"},[e._v(e._s(e.$t("backups.created")))])]),t("ul",{staticClass:"backups-list"},e._l(e.backups,function(i){return t("backup-entry",{key:i.filename,attrs:{backup:i,downloading:e.downloading==i.filename},on:{download:e.copyAndDownload,delete:function(o){return e.openBackupDeleteDialog(i)}}})}),1)]):t("div",{staticClass:"backups-placeholder"},[t("div",{staticClass:"backups-placeholder-empty"},[e._v(e._s(e.$t("backups.placeholder")))])]),t("backup-delete-dialog",{ref:"backup-delete",on:{deleted:e.$reload}}),t("backups-delete-dialog",{ref:"backups-delete",attrs:{backups:e.backups},on:{deleted:e.$reload}})],1)],1)},E=[],Z="";const P={components:{"backup-entry":w,"backup-delete-dialog":x,"backups-delete-dialog":T},props:{backups:Array,title:String},data(){return{downloading:!1,creationStatus:"default"}},mounted(){window.beforeunload=this.deletePublicBackups()},destroyed(){this.deletePublicBackups()},methods:{deletePublicBackups(){this.$api.post("backups/delete-public-backups")},async createBackup(){this.creationStatus="progress";try{const e=await this.$api.get("backups/create-backup");await this.$reload(),this.setCreationStatus(e.status,!0)}catch{this.setCreationStatus("error",!0)}},setCreationStatus(e,a=!0){this.creationStatus=e==200?"success":"error",a&&setTimeout(()=>{this.creationStatus="default"},2e3)},async copyAndDownload(e){this.downloading=e,e=e=="latest"?this.backups[0].filename:e;const a=await this.$api.get("backups/copy-to-assets",{filename:e});a.url&&(window.location=a.url),this.downloading=!1},openBackupDeleteDialog(e){this.$refs["backup-delete"].open(e)},openBackupsDeleteDialog(){this.$refs["backups-delete"].open()}}},p={};var F=r(P,V,E,!1,H,null,null,null);function H(e){for(let a in p)this[a]=p[a]}var W=function(){return F.exports}();panel.plugin("sylvainjule/backups",{components:{"k-backups-view":W},icons:{backup:'<path d="M7.12,11.86a.56.56,0,0,1-.4-.16l-2-2a.56.56,0,0,1,.79-.79L7.12,10.5l3.56-3.56a.56.56,0,0,1,.79.79l-4,4A.56.56,0,0,1,7.12,11.86Z"/><path d="M14,15.45H2.17A2.17,2.17,0,0,1,0,13.28V1.41A.69.69,0,0,1,.69.72H6.13a.69.69,0,0,1,.59.33L8,3.19h7.52a.69.69,0,0,1,.69.69v9.4A2.17,2.17,0,0,1,14,15.45ZM1.38,2.1V13.28a.8.8,0,0,0,.79.79H14a.8.8,0,0,0,.8-.79V4.57H7.61A.69.69,0,0,1,7,4.23L5.74,2.1Z"/>',backupsLoader:'<g fill="none" fill-rule="evenodd"><g transform="translate(1 1)" stroke-width="1.75"><circle cx="7" cy="7" r="7.2" stroke="#000" stroke-opacity=".2"/><path d="M14.2,7c0-4-3.2-7.2-7.2-7.2" stroke="#000"><animateTransform attributeName="transform" type="rotate" from="0 7 7" to="360 7 7" dur="1s" repeatCount="indefinite"/></path></g></g>'}})})();
