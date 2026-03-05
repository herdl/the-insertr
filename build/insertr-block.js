(function (wp) {
  if (!wp || !wp.blocks || !wp.element || !wp.blockEditor || !wp.components) {
    return;
  }

  var el = wp.element.createElement;
  var registerBlockType = wp.blocks.registerBlockType;
  var useBlockProps = wp.blockEditor.useBlockProps;
  var InspectorControls = wp.blockEditor.InspectorControls;
  var PanelBody = wp.components.PanelBody;
  var TextControl = wp.components.TextControl;
  var SelectControl = wp.components.SelectControl;

  registerBlockType('herdl/insertr', {
    edit: function (props) {
      var attributes = props.attributes;
      var setAttributes = props.setAttributes;
      var blockProps = useBlockProps ? useBlockProps() : { className: 'wp-block-herdl-insertr' };

      var keyLabel = attributes.key ? attributes.key : 'keyword';
      var fallbackLabel = attributes.fallback ? attributes.fallback : '…';
      var preview = 'Insertr: ' + keyLabel + ' → ' + fallbackLabel;

      return el(
        wp.element.Fragment,
        {},
        el(
          InspectorControls,
          {},
          el(
            PanelBody,
            { title: 'Insertr settings', initialOpen: true },
            el(TextControl, {
              label: 'URL parameter (key)',
              value: attributes.key,
              onChange: function (val) {
                setAttributes({ key: val || 'keyword' });
              },
              help: 'Query parameter name, e.g. keyword for ?keyword=value',
            }),
            el(TextControl, {
              label: 'Fallback text',
              value: attributes.fallback,
              onChange: function (val) {
                setAttributes({ fallback: val || '' });
              },
              help: 'Shown when the URL has no matching parameter',
            }),
            el(SelectControl, {
              label: 'Case',
              value: attributes.case || 'lower',
              options: [
                { label: 'Lowercase', value: 'lower' },
                { label: 'Uppercase', value: 'upper' },
                { label: 'Title case', value: 'title' },
              ],
              onChange: function (val) {
                setAttributes({ case: val || 'lower' });
              },
            })
          )
        ),
        el(
          'div',
          blockProps,
          el('span', { className: 'wp-block-herdl-insertr__preview' }, preview)
        )
      );
    },

    save: function () {
      return null;
    },
  });
})(window.wp);
