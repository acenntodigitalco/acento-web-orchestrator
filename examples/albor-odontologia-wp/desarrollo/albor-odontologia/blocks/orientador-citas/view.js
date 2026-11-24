import { store, getContext, getElement } from '@wordpress/interactivity';

const { state } = store('albor/orientador', {
  state: {
    get current() {
      const ctx = getContext();
      return ctx.items[ctx.selected] || ctx.items.valoracion;
    },
    get isSelected() {
      const ctx = getContext();
      const { ref } = getElement();
      const slug = ctx.buttonSlug || ref?.dataset?.motivo;
      return slug === ctx.selected;
    },
    get waHref() {
      const current = state.current;
      return 'https://wa.me/573000000000?text=' + encodeURIComponent(current.waText);
    }
  },
  actions: {
    selectMotivo() {
      const ctx = getContext();
      const { ref } = getElement();
      const motivo = ctx.buttonSlug || ref?.dataset?.motivo;
      if (!motivo || !ctx.items[motivo]) return;
      ctx.selected = motivo;

      if (window.AlborTracking) {
        window.AlborTracking.pushEvent('treatment_filter', {
          motivo_slug: motivo,
          motivo_label: ctx.items[motivo].label
        });
      }
    }
  }
});
