(function() {
	tinymce.PluginManager.add('divergent_mce_button', function( editor, url ) {
		editor.addButton( 'divergent_mce_button', {
			text: 'DV Shortcodes',
			icon: false,
			type: 'menubutton',
			menu: [
				{
					text: 'Custom Post Types',
					menu: [
						{
							text: 'DV Gallery',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Insert DV Gallery',
									body: [
										{
											type: 'textbox',
											name: 'max',
											label: 'Maximum number of galleries:',
											value: '99'
										},
                                        {
											type: 'textbox',
											name: 'catid',
											label: 'Category ID:',
											value: ''
										},
                                        {
											type: 'textbox',
											name: 'thumbnailwidth',
											label: 'Max. Item Width:',
											value: '200'
										}
									],
									onsubmit: function( e ) {
                                        if(isNaN(e.data.max)) {
                                            editor.windowManager.alert('Maximum number of galleries must be a number.');
                                            return false;
                                        }
                                        if(isNaN(e.data.catid)) {
                                            editor.windowManager.alert('Category ID must be a number.');
                                            return false;
                                        }
                                        if(isNaN(e.data.thumbnailwidth)) {
                                            editor.windowManager.alert('Item width must be a number.');
                                            return false;
                                        }
										editor.insertContent( '[dvgrid max="' + e.data.max + '" categoryid="' + e.data.catid + '" itemwidth="' + e.data.thumbnailwidth + '"]');
									}
								});
							}
						},
						{
							text: 'DV Gallery with Filters',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Insert DV Gallery with Filters',
									body: [
										{
											type: 'textbox',
											name: 'max',
											label: 'Maximum number of galleries:',
											value: '99'
										},
                                        {
											type: 'textbox',
											name: 'thumbnailwidth',
											label: 'Max. Item Width:',
											value: '200'
										}
									],
									onsubmit: function( e ) {
                                        if(isNaN(e.data.max)) {
                                            editor.windowManager.alert('Maximum number of galleries must be a number.');
                                            return false;
                                        }
                                        if(isNaN(e.data.thumbnailwidth)) {
                                            editor.windowManager.alert('Max. item width must be a number.');
                                            return false;
                                        }
										editor.insertContent( '[dvgridfilter max="' + e.data.max + '" itemwidth="' + e.data.thumbnailwidth + '"]');
									}
								});
							}
						},
                        {
							text: 'DV Square Gallery',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Insert DV Square Gallery',
									body: [
										{
											type: 'textbox',
											name: 'max',
											label: 'Maximum number of galleries:',
											value: '99'
										},
                                        {
											type: 'textbox',
											name: 'catid',
											label: 'Category ID:',
											value: ''
										}
									],
									onsubmit: function( e ) {
                                        if(isNaN(e.data.max)) {
                                            editor.windowManager.alert('Maximum number of galleries must be a number.');
                                            return false;
                                        }
                                        if(isNaN(e.data.catid)) {
                                            editor.windowManager.alert('Category ID must be a number.');
                                            return false;
                                        }
										editor.insertContent( '[dvsquare max="' + e.data.max + '" categoryid="' + e.data.catid + '"]');
									}
								});
							}
						},
                        {
							text: 'DV Testimonials',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Insert DV Testimonials',
									body: [
                                        {
											type: 'listbox',
											name: 'autoplay',
											label: 'Autoplay:',
											'values': [
												{text: 'False', value: 'false'},
												{text: 'True', value: 'true'}
											]
										},
                                        {
											type: 'textbox',
											name: 'duration',
											label: 'Autoplay Duration:',
											value: '4'
										},
                                        {
											type: 'listbox',
											name: 'navarrows',
											label: 'Navigation arrows:',
											'values': [
												{text: 'Enable', value: 'true'},
												{text: 'Disable', value: 'false'}
											]
										},
                                        {
											type: 'listbox',
											name: 'navnumbers',
											label: 'Navigation numbers:',
											'values': [
												{text: 'Enable', value: 'true'},
												{text: 'Disable', value: 'false'}
											]
										},
									],
									onsubmit: function( e ) {
                                        if(isNaN(e.data.duration)) {
                                            editor.windowManager.alert('Duration must be a number.');
                                            return false;
                                        }
										editor.insertContent( '[dvtestimonials autoplay="' + e.data.autoplay + '" duration="' + e.data.duration + '" arrows="' + e.data.navarrows + '" numbers="' + e.data.navnumbers + '"]');
									}
								});
							}
						}
					]
				},
                {
					text: 'Lists',
					menu: [
                        {
							text: 'Accordion',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add an Accordion',
									body: [
                                        {
											type: 'textbox',
											name: 'tabnumber',
											label: 'Number of item:',
											value: '3'
										}
									],
									onsubmit: function( e ) {
                                        if(isNaN(e.data.tabnumber)) {
                                            editor.windowManager.alert('Number of item must be a number.');
                                            return false;
                                        }
                                        else {
                                            var i = 0;
                                            editor.insertContent('[accordioncontainer]<br/><br/>');
                                            while (i < e.data.tabnumber) {
                                                editor.insertContent( '[accordion title="Title Here" icon=""][/accordion]<br/><br/>');
                                                i++;
                                            }
                                            editor.insertContent('[/accordioncontainer]');
                                        }
									}
								});
							}
						},
                        {
							text: 'Tabs',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add a Tabs',
									body: [
                                        {
											type: 'textbox',
											name: 'tabnumber',
											label: 'Number of item:',
											value: '3'
										},
                                        {
											type: 'listbox',
											name: 'type',
											label: 'Type:',
											'values': [
												{text: 'Default', value: 'default'},
												{text: 'Vertical', value: 'vertical'}
											]
										}
									],
									onsubmit: function( e ) {
                                        if(isNaN(e.data.tabnumber)) {
                                            editor.windowManager.alert('Number of item must be a number.');
                                            return false;
                                        }
                                        else {
                                            var i = 0;
                                            editor.insertContent('[tabgroup type="' + e.data.type + '"]<br/><br/>');
                                            while (i < e.data.tabnumber) {
                                                editor.insertContent( '[tab title="Title Here"][/tab]<br/><br/>');
                                                i++;
                                            }
                                            editor.insertContent('[/tabgroup]');
                                        }
									}
								});
							}
						},
                        {
							text: 'Table',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add a Table',
									body: [
                                        {
											type: 'textbox',
											name: 'tablenumber',
											label: 'Number of item:',
											value: '3'
										}
									],
									onsubmit: function( e ) {
                                        if(isNaN(e.data.tablenumber)) {
                                            editor.windowManager.alert('Number of item must be a number.');
                                            return false;
                                        }
                                        else {
                                            var i = 0;
                                            editor.insertContent('[dvtable]<br/><br/>');
                                            while (i < e.data.tablenumber) {
                                                editor.insertContent( '[dvtableitem left="Left Text Here" right="Right Text Here" icon=""]<br/><br/>');
                                                i++;
                                            }
                                            editor.insertContent('[/dvtable]');
                                        }
									}
								});
							}
						},
                        {
							text: 'DV Icons',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add DV Icons',
									body: [
                                        {
											type: 'textbox',
											name: 'tabnumber',
											label: 'Number of item:',
											value: '4'
										}
									],
									onsubmit: function( e ) {
                                        if(isNaN(e.data.tabnumber)) {
                                            editor.windowManager.alert('Number of item must be a number.');
                                            return false;
                                        }
                                        else {
                                            var i = 0;
                                            editor.insertContent('[dviconcontainer]<br/><br/>');
                                            while (i < e.data.tabnumber) {
                                                editor.insertContent( '[dvicon title="Title Here" icon="user" link=""][/dvicon]<br/><br/>');
                                                i++;
                                            }
                                            editor.insertContent('[/dviconcontainer]');
                                        }
									}
								});
							}
						},
                        {
							text: 'DV Resume',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add a DV Resume Box',
									body: [
                                        {
											type: 'textbox',
											name: 'boxtitle',
											label: 'Title:',
											value: ''
										},
                                        {
											type: 'textbox',
											name: 'boxsubtitle',
											label: 'Sub Title:',
											value: ''
										},
                                        {
											type: 'textbox',
											name: 'boxtext',
											label: 'Text:',
											value: '',
                                            multiline: true,
                                            minWidth: 300,
                                            minHeight: 100
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[dvresume title="' + e.data.boxtitle + '" subtitle="' + e.data.boxsubtitle + '"]<p>' + e.data.boxtext + '</p>[/dvresume]');
									}
								});
							}
						},
                        {
							text: 'DV Skill',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add a Skill',
									body: [
                                        {
											type: 'textbox',
											name: 'boxtitle',
											label: 'Title:',
											value: ''
										},
                                        {
											type: 'textbox',
											name: 'boxpercent',
											label: 'Percent:',
											value: ''
										}
									],
									onsubmit: function( e ) {
                                        if(isNaN(e.data.boxpercent)) {
                                            editor.windowManager.alert('Percent must be a number between 1-100.');
                                            return false;
                                        }
                                        else {
                                            editor.insertContent( '[dvskill title="' + e.data.boxtitle + '" percent="' + e.data.boxpercent + '"]');
                                        }
									}
								});
							}
						},
                        {
							text: 'DV Blog',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add Blog Posts',
									body: [
                                        {
											type: 'textbox',
											name: 'maxnumber',
											label: 'Max. Number of post:',
											value: '5'
										},
                                        {
											type: 'textbox',
											name: 'catid',
											label: 'Category ID:',
											value: ''
										},
                                        {
											type: 'textbox',
											name: 'viewall',
											label: 'View All Button Text:',
											value: ''
										},
									],
									onsubmit: function( e ) {
                                        if(isNaN(e.data.maxnumber)) {
                                            editor.windowManager.alert('Maximum Number of post must be a number.');
                                            return false;
                                        }
                                        if(isNaN(e.data.catid)) {
                                            editor.windowManager.alert('Category ID must be a number.');
                                            return false;
                                        }
                                        else {
                                            var i = 0;
                                            editor.insertContent('[dvblog max="' + e.data.maxnumber + '" categoryid="' + e.data.catid + '" viewall="' + e.data.viewall + '"]');
                                        }
									}
								});
							}
						}
                    ]
                },
				{
					text: 'Others',
					menu: [
                        {
							text: 'Title with border',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add a title with border',
									body: [
                                        {
                                            type: 'textbox',
                                            name: 'title',
                                            label: 'Your title:'
                                        },
                                        {
											type: 'listbox',
											name: 'level',
											label: 'Header Level:',
											'values': [
												{text: 'Heading 1', value: 'h1'},
												{text: 'Heading 2', value: 'h2'},
                                                {text: 'Heading 3', value: 'h3'},
                                                {text: 'Heading 4', value: 'h4'},
                                                {text: 'Heading 5', value: 'h5'},
                                                {text: 'Heading 6', value: 'h6'}
											]
										}
									],
									onsubmit: function( e ) {
                                            editor.insertContent( '<' + e.data.level + ' class="border">' + e.data.title + '</' + e.data.level + '>');
									}
								});
							}
						},
                        {
							text: 'Iframe',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Insert an iframe',
									body: [
                                        {
											type: 'textbox',
											name: 'url',
											label: 'Iframe URL:',
											value: 'https://www.youtube.com/embed/kuceVNBTJio'
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[iframecode url="' + e.data.url + '"]');
									}
								});
							}
						},
                        {
							text: 'Button',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Insert a Button',
									body: [
                                        {
											type: 'textbox',
											name: 'buttonurl',
											label: 'URL:',
											value: ''
										},
                                        {
											type: 'textbox',
											name: 'buttontext',
											label: 'Button Text:',
											value: 'Click Here'
										},
                                        {
											type: 'listbox',
											name: 'buttonstyle',
											label: 'Style:',
											'values': [
												{text: 'Primary', value: 'primary'},
												{text: 'Secondary', value: ''}
											]
										},
                                        {
											type: 'listbox',
											name: 'newtab',
											label: 'Open in a new tab:',
											'values': [
												{text: 'No', value: ''},
												{text: 'Yes', value: 'yes'}
											]
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[dvbutton url="' + e.data.buttonurl + '" style="'+ e.data.buttonstyle +'" newtab="'+ e.data.newtab +'"]' + e.data.buttontext + '[/dvbutton]');
									}
								});
							}
						},
                        {
							text: 'Section Button',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Insert a Button',
									body: [
                                        {
											type: 'container',
											html: 'You can use this shortcode only on the homepage template.'
										},
                                        {
											type: 'textbox',
											name: 'buttonid',
											label: 'ID:',
											value: '1'
										},
                                        {
											type: 'textbox',
											name: 'buttonslug',
											label: 'Slug:',
											value: 'home'
										},
                                        {
											type: 'textbox',
											name: 'buttontext',
											label: 'Button Text:',
											value: 'Click Here'
										},
                                        {
											type: 'listbox',
											name: 'buttonstyle',
											label: 'Style:',
											'values': [
												{text: 'Primary', value: 'primary'},
												{text: 'Secondary', value: ''}
											]
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[dvsectionbutton id="' + e.data.buttonid + '" style="'+ e.data.buttonstyle +'" slug="'+ e.data.buttonslug +'"]' + e.data.buttontext + '[/dvsectionbutton]');
									}
								});
							}
						},
                        {
							text: 'Box',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Insert a Box',
									body: [
                                        {
											type: 'textbox',
											name: 'boxtitle',
											label: 'Title:',
											value: ''
										},
                                        {
											type: 'listbox',
											name: 'boxstyle',
											label: 'Style:',
											'values': [
												{text: 'Light', value: 'light'},
												{text: 'Dark', value: 'dark'},
												{text: 'Red', value: 'red'}
											]
										},
                                        {
											type: 'textbox',
											name: 'boxtext',
											label: 'Text:',
											value: '',
                                            multiline: true,
                                            minWidth: 300,
                                            minHeight: 100
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[dvbox title="' + e.data.boxtitle + '" style="'+ e.data.boxstyle +'"]<p>' + e.data.boxtext + '</p>[/dvbox]');
									}
								});
							}
						},
                        {
							text: 'Label',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Insert a label',
									body: [
                                        {
											type: 'textbox',
											name: 'text',
											label: 'Text:',
											value: '',
                                            multiline: true,
                                            minWidth: 300,
                                            minHeight: 100
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[dvlabel]' + e.data.text + '[/dvlabel]');
									}
								});
							}
						},
                        {
							text: 'Image with Caption',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Insert an Image Container',
									body: [
                                        {
											type: 'textbox',
											name: 'caption',
											label: 'Caption:',
											value: ''
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[fleximage imgcaption="' + e.data.caption + '"]<br/><br/>[/fleximage]');
									}
								});
							}
						}
					]
				}
			]
		});
	});
})();