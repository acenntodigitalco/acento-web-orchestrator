(function (blocks, element, blockEditor, components) {
  var el = element.createElement;
  var useBlockProps = blockEditor.useBlockProps;
  var InspectorControls = blockEditor.InspectorControls;
  var PanelBody = components.PanelBody;
  var TextControl = components.TextControl;

  blocks.registerBlockType('albor/orientador-citas', {
    edit: function (props) {
      var blockProps = useBlockProps({ className: 'albor-orientador albor-orientador--editor' });
      return el(
        element.Fragment,
        null,
        el(
          InspectorControls,
          null,
          el(
            PanelBody,
            { title: 'Encabezado del orientador' },
            el(TextControl, {
              label: 'Título',
              value: props.attributes.titulo,
              onChange: function (val) {
                props.setAttributes({ titulo: val });
              }
            })
          )
        ),
        el(
          'div',
          blockProps,
          el('p', { className: 'albor-orientador__eyebrow' }, 'Orientador interactivo Albor (WP Interactivity API)'),
          el('h3', { className: 'albor-orientador__title' }, props.attributes.titulo || '¿Qué te gustaría revisar?'),
          el(
            'p',
            { className: 'albor-orientador__desc' },
            'En la web pública permite elegir entre Valoración general, Implantes, Ortodoncia o Urgencia y actualiza duración, tarifa orientativa y enlace directo a cita.'
          )
        )
      );
    },
    save: function () {
      return null;
    }
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.components);
