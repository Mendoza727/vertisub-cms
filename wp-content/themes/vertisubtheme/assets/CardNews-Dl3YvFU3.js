import { R as p, r as f, j as a } from "./index-5_OOGiqd.js";
import { g as m, S as C } from "./SmootherLayout-DPjoTzjc.js";
function x() {
  return (
    (x =
      Object.assign ||
      function (e) {
        for (var t = 1; t < arguments.length; t++) {
          var o = arguments[t];
          for (var r in o)
            Object.prototype.hasOwnProperty.call(o, r) && (e[r] = o[r]);
        }
        return e;
      }),
    x.apply(this, arguments)
  );
}
function b(e, t) {
  (e.prototype = Object.create(t.prototype)),
    (e.prototype.constructor = e),
    v(e, t);
}
function v(e, t) {
  return (
    (v =
      Object.setPrototypeOf ||
      function (r, n) {
        return (r.__proto__ = n), r;
      }),
    v(e, t)
  );
}
var j = (function (e) {
  b(t, e);
  function t() {
    return e.apply(this, arguments) || this;
  }
  var o = t.prototype;
  return (
    (o.getColumns = function () {
      var n = this.props,
        s = n.children,
        d = n.columnsCount,
        i = Array.from({ length: d }, function () {
          return [];
        }),
        u = 0;
      return (
        p.Children.forEach(s, function (c) {
          c && p.isValidElement(c) && (i[u % d].push(c), u++);
        }),
        i
      );
    }),
    (o.renderColumns = function () {
      var n = this.props,
        s = n.gutter,
        d = n.itemTag,
        i = n.itemStyle;
      return this.getColumns().map(function (u, c) {
        return p.createElement(
          d,
          {
            key: c,
            style: x(
              {
                display: "flex",
                flexDirection: "column",
                justifyContent: "flex-start",
                alignContent: "stretch",
                flex: 1,
                width: 0,
                gap: s,
              },
              i
            ),
          },
          u.map(function (h) {
            return h;
          })
        );
      });
    }),
    (o.render = function () {
      var n = this.props,
        s = n.gutter,
        d = n.className,
        i = n.style,
        u = n.containerTag;
      return p.createElement(
        u,
        {
          style: x(
            {
              display: "flex",
              flexDirection: "row",
              justifyContent: "center",
              alignContent: "stretch",
              boxSizing: "border-box",
              width: "100%",
              gap: s,
            },
            i
          ),
          className: d,
        },
        this.renderColumns()
      );
    }),
    t
  );
})(p.Component);
j.propTypes = {};
j.defaultProps = {
  columnsCount: 3,
  gutter: "0",
  className: null,
  style: {},
  containerTag: "div",
  itemTag: "div",
  itemStyle: {},
};
var $ = 1,
  N = typeof window < "u" ? f.useLayoutEffect : f.useEffect,
  E = function () {
    var t = f.useState(!1),
      o = t[0],
      r = t[1];
    return (
      N(function () {
        r(!0);
      }, []),
      o
    );
  },
  M = function () {
    var t = E(),
      o = f.useState(typeof window < "u" ? window.innerWidth : 0),
      r = o[0],
      n = o[1],
      s = f.useCallback(
        function () {
          t && n(window.innerWidth);
        },
        [t]
      );
    return (
      N(
        function () {
          if (t)
            return (
              window.addEventListener("resize", s),
              s(),
              function () {
                return window.removeEventListener("resize", s);
              }
            );
        },
        [t, s]
      ),
      r
    );
  },
  S = function (t) {
    var o = t.columnsCountBreakPoints,
      r = o === void 0 ? { 350: 1, 750: 2, 900: 3 } : o,
      n = t.children,
      s = t.className,
      d = s === void 0 ? null : s,
      i = t.style,
      u = i === void 0 ? null : i,
      c = M(),
      h = f.useMemo(
        function () {
          var l = Object.keys(r).sort(function (w, _) {
              return w - _;
            }),
            g = l.length > 0 ? r[l[0]] : $;
          return (
            l.forEach(function (w) {
              w < c && (g = r[w]);
            }),
            g
          );
        },
        [c, r]
      );
    return p.createElement(
      "div",
      { className: d, style: u },
      p.Children.map(n, function (l, g) {
        return p.cloneElement(l, { key: g, columnsCount: h });
      })
    );
  };
S.propTypes = {};
const y =
    "data:image/svg+xml,%3csvg%20width='19'%20height='19'%20viewBox='0%200%2019%2019'%20fill='none'%20xmlns='http://www.w3.org/2000/svg'%3e%3cpath%20d='M1.75%2017.25L18%201M18%201V16.6M18%201H2.4'%20stroke='white'%20stroke-width='2'%20stroke-linecap='round'%20stroke-linejoin='round'%20/%3e%3c/svg%3e",
  k = ({
    id: e,
    title: t,
    description: o,
    image: r,
    date: n,
    url: s,
    category: d,
    type: i = "image",
    size: u = "small",
  }) => {
    if (
      (m.registerPlugin(C),
      f.useLayoutEffect(() => {
        if (i !== "image" || !document.querySelector(`.card-news-${e}`)) return;
        const c = m.context(() => {
          m.matchMedia().add("(max-width: 640px)", () => {
            const l = m.timeline({
              scrollTrigger: {
                trigger: `.card-news-${e}`,
                start: "top 40%",
                end: "bottom 45%",
                toggleActions: "restart none none reverse",
              },
              defaults: { duration: 0.3, ease: "power4.inOut" },
            });
            l.to(
              `.card-news-${e} .card-news__image img`,
              { scale: 1.1, opacity: 0.3 },
              "a"
            ),
              l.to(`.card-news-${e} .card-news__content`, { bottom: 0 }, "a");
          });
        });
        return () => c.revert();
      }, []),
      f.useLayoutEffect(() => {
        if (i !== "text" || !document.querySelector(`.card-news-text-${e}`))
          return;
        const c = m.context(() => {
          m.matchMedia().add("(max-width: 640px)", () => {
            m.set(`.card-news-text-${e} img`, { display: "none" });
            const l = m.timeline({
              scrollTrigger: {
                trigger: `.card-news-text-${e}`,
                start: "top 40%",
                end: "bottom 40%",
                toggleActions: "restart none none reverse",
              },
              defaults: { duration: 0.3, ease: "power4.inOut" },
            });
            l.to(`.card-news-text-${e} :is(h4, h5, p)`, { color: "#fff" }, "a"),
              l.to(
                `.card-news-text-${e} `,
                { backgroundColor: "#E73B1F" },
                "a"
              ),
              l.to(`.card-news-text-${e} img`, { display: "block" }, "a");
          });
        });
        return () => c.revert();
      }, []),
      i === "image")
    )
      return a.jsx("a", {
        href: s,
        target: s === "#" ? undefined : "_blank",
        rel: s === "#" ? undefined : "noopener noreferrer",
        children: a.jsxs("article", {
          className: `card-news card-news-${e} lg:order-none`,
          children: [
            a.jsx("div", {
              className: "card-news__image",
              children: a.jsx("div", {
                className: "w-full h-full bg-transparent",
                children: a.jsx("img", {
                  src: r.url,
                  loading: "lazy",
                  alt: r.alt,
                  className:
                    "w-full h-full object-cover object-top transition-all duration-[600ms] ease-in-out hover:bg-black-500/90",
                }),
              }),
            }),
            a.jsxs("div", {
              className: "card-news__content",
              children: [
                a.jsxs("div", {
                  className: "flex w-full justify-between items-start",
                  children: [
                    a.jsx("h4", { className: "line-clamp-2", children: t }),
                    a.jsx("img", {
                      src: y,
                      alt: "Arrow icon to redirect to a new page",
                      className: "mt-[8px] w-[16px] h-[16px]",
                    }),
                  ],
                }),
                a.jsx("h5", {
                  children: new Date(n).toLocaleDateString("es-CO", {
                    day: "2-digit",
                    month: "long",
                    year: "numeric",
                  }),
                }),
                a.jsx("p", { className: "line-clamp-2", children: o }),
              ],
            }),
          ],
        }),
      });
    if (i === "text")
      return a.jsx("a", {
        href: s,
        target: "_blank",
        rel: "noopener noreferrer",
        children: a.jsxs("article", {
          className: `card-news-text card-news-text-${e} group/card ${
            u === "small" ? "h-[310px]" : " h-[415px]"
          }`,
          children: [
            a.jsxs("div", {
              className: "flex w-full justify-between items-start",
              children: [
                a.jsx("h4", {
                  className: "group-hover/card:text-white",
                  children: t,
                }),
                a.jsx("img", {
                  src: y,
                  alt: "Arrow icon to redirect to a new page",
                  className:
                    "hidden group-hover/card:block mt-[6px] w-[16px] h-[16px]",
                }),
              ],
            }),
            a.jsx("h5", {
              className: "group-hover/card:text-white",
              children: new Date(n).toLocaleDateString("es-CO", {
                day: "2-digit",
                month: "long",
                year: "numeric",
              }),
            }),
            a.jsx("p", {
              className: `group-hover/card:text-white ${
                u === "small" ? "line-clamp-5" : "line-clamp-[10]"
              }`,
              children: o,
            }),
          ],
        }),
      });
  };
export { k as C, S as M, j as a };
