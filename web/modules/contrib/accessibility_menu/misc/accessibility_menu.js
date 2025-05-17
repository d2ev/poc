(function () {

  class AccessibilityMenu {

    settings = {
      fontSizeLimit: 30,
    };

    defaults = {
      fontSize: [1.15, 1.35, 1.55, 1.7],
      lineHeight: [1.25, 1.5, 1.75],
      letterSpacing: [1.25, 1.75, 2.25],
      fontFamily: ['serif', 'sans-serif'],
    };

    map = {
      fontSize: 'font_size',
      lineHeight: 'line_height',
      letterSpacing: 'letter_spacing',
      fontFamily: 'font_style',
    };

    constructor(element) {
      this.wrapper = element;
      this.buttons = {};
      this.buttons.close = this.wrapper.querySelector('.js-accessibility-close');
      this.buttons.open = document.querySelector('.js-accessibility-btn');
      this.buttons.reset = this.wrapper.querySelector('.js-accessibility-reset');
      this.container = this.wrapper.querySelector('.b-accessibility-menu');
      this.init();
    }

    init = function () {
      const self = this;
      document.addEventListener('click', (e) => {
        if (!e.target.closest('.js-accessibility-menu') && !e.target.closest('.js-accessibility-btn')) {
          self.close();
        }
      });
      self.buttons.open.addEventListener('click', self.open.bind(self));
      self.buttons.close.addEventListener('click', self.close.bind(self));
      self.buttons.reset.addEventListener('click', () => {
        self.reset();
      });
      self.container.addEventListener('click', (e) => {
        const target = e.target.closest('.b-accessibility-menu__item');
        if (target) {
          self.itemClick(target);
          self.refresh();
        }
      });
      if (localStorage.getItem('accessibility_menu')) {
        self.refresh();
      }
    };
    refresh = function () {
      const self = this;
      self.container.querySelectorAll('.b-accessibility-menu__item').forEach((element) => {
        self.itemClick(element, false);
      });
      let storage = localStorage.getItem('accessibility_menu');
      storage = JSON.parse(storage) ?? {};

      let elements = document.querySelectorAll('body *');
      elements.forEach((element) => {
        let styles = getComputedStyle(element);
        if (!element.prepare) {
          element.prepare = {};
        }
        for (let type in self.defaults) {
          if (styles[type] !== undefined) {
            if (!element.initialStyles) {
              element.initialStyles = {};
            }
            if (!element?.initialStyles[type]) {
              let propertyValue = styles[type];
              switch (type) {
                case 'letterSpacing':
                  if (propertyValue === 'normal') {
                    propertyValue = 1;
                  }
                  element.initialStyles[type] = parseFloat(propertyValue);
                  break;

                default:
                  element.initialStyles[type] = parseFloat(propertyValue);
                  break;
              }
            }

            let value = element.initialStyles[type];
            let coef = self.defaults[type][storage[self.map[type]]];
            if (coef === undefined) {
              element.prepare[type] = '';
            } else {
              switch (type) {
                case 'fontFamily':
                  element.prepare[type] = coef;
                  break;

                case 'fontSize':
                  let max = value > self.settings.fontSizeLimit ? value : self.settings.fontSizeLimit;
                  element.prepare[type] = ((value * coef) > max ? max : value * coef) + 'px';
                  break;

                default:
                  element.prepare[type] = (coef * value) + 'px';
                  break;
              }
            }
          }
        }
      });
      document.body.classList.remove('images-grayscale');
      document.body.classList.remove('images-none');
      document.body.classList.remove('am-big-cursor');
      self.removeReadingLine();
      switch (storage['reading_line']) {
        case 0:
          self.initReadingLine();
          break;
      }
      switch (storage['cursor']) {
        case 0:
          document.body.classList.add('am-big-cursor');
          break;
      }
      switch (storage['images']) {
        case 0:
          document.body.classList.add('images-grayscale');
          break;
        case 1:
          document.body.classList.add('images-none');
          break;
      }

      delete document.body.dataset.am_theme;
      if (storage?.contrast !== undefined) {
        document.body.dataset.am_theme = 'theme_' + storage['contrast'];
      }

      elements.forEach((element) => {
        if (element.prepare) {
          if (element.closest('.js-accessibility-menu')) {
            return;
          }
          for (let style in element.prepare) {
            element.style[style] = element.prepare[style];
          }
        }
      });
    };

    _getElementIndex = function (node) {
      let index = 0;
      while ((node = node.previousElementSibling)) {
        index++;
      }
      return index;
    };

    getValue = function (item) {
      const type = item.dataset.type;
      let storage = localStorage.getItem('accessibility_menu');
      storage = JSON.parse(storage) ?? {};
      if (storage[type] !== undefined) {
        return storage[type];
      }
      return undefined;
    };
    setValue = function (item, value) {
      const type = item.dataset.type;
      let storage = localStorage.getItem('accessibility_menu');
      storage = JSON.parse(storage) ?? {};
      storage[type] = value;
      if (value === undefined) {
        delete (storage[type]);
      }
      storage = JSON.stringify(storage);
      if (storage === '{}') {
        localStorage.removeItem('accessibility_menu');
      } else {
        localStorage.setItem('accessibility_menu', storage);
      }

    };
    reset = function () {
      const self = this;
      localStorage.removeItem('accessibility_menu');
      self.refresh();
    };

    itemClick = function (item, increase = true) {
      const self = this;
      let value = self.getValue(item);
      if (increase) {
        if (value !== undefined) {
          value++;
        } else {
          value = 0;
        }
      }
      let title = item.dataset?.title ?? '';
      let setValue = undefined;
      let links = item.querySelectorAll('.js-accessibility-link');
      links.forEach((element) => {
        element.classList.remove('is-active');
        const index = self._getElementIndex(element);
        if (index === value) {
          title = element.dataset.title ?? title;
          setValue = index;
        }
        if (index <= value) {
          element.classList.add('is-active');
        }
      });
      self.setValue(item, setValue);
      item.querySelector('.b-accessibility-menu__title span').innerText = title;
      if (setValue !== undefined) {
        item.classList.add('is-active');
      } else {
        item.classList.remove('is-active');
      }
    };

    open = function () {
      const self = this;
      if (!self.wrapper.classList.contains('is-open')) {
        self.wrapper.classList.add('is-open');
        setTimeout(() => {
          self.container.classList.add('is-open');
        }, 16);
      }
    };
    close = function () {
      const self = this;
      if (self.wrapper.classList.contains('is-open')) {
        self.container.classList.remove('is-open');
        self.wrapper.classList.remove('is-open');
      }
    };

    initReadingLine = function () {
      if (!this.container.line) {
        const line = document.createElement('div');
        line.classList.add('am-reading-line');
        line.classList.add('am-skip');
        document.body.append(line);
        this.container.line = line;
        window.addEventListener('mousemove', this.moveMouse.bind(this));
      }
    };
    removeReadingLine = function () {
      if (this.container.line) {
        window.removeEventListener('mousemove', this.moveMouse.bind(this));
        this.container.line.remove();
        this.container.line = null;
      }
    };
    moveMouse = function (t) {
      this.container.line && this.container.line.style && (this.container.line.style.top = t.y + 'px');
    };
  }

  document.addEventListener('DOMContentLoaded', function (event) {
    const menuContainer = document.querySelector('.js-accessibility-menu');
    if (menuContainer) {
      const menu = new AccessibilityMenu(menuContainer);
      document.querySelector('.notyf')?.classList?.add('am-skip');
    }
  });

})();
