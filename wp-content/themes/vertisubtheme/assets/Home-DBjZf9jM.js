import { r as N, j as a, L as Ae, a as pt, b as Tt } from "./index-5_OOGiqd.js";
import { L as Vt, d as It } from "./thumbnail-Dv4-UVAT.js";
import {
  T as W,
  g as y,
  E as Bt,
  S as ht,
  P as re,
  a as Mt,
  u as Ot,
  N as Dt,
} from "./SmootherLayout-DPjoTzjc.js";
import { U as ut } from "./UpperCircle-CXml2Tqv.js";
import { M as At, a as Rt, C as Ft } from "./CardNews-Dl3YvFU3.js";
/*!
 * matrix 3.12.2
 * https://greensock.com
 *
 * Copyright 2008-2023, GreenSock. All rights reserved.
 * Subject to the terms at https://greensock.com/standard-license or for
 * Club GreenSock members, the agreement issued with that membership.
 * @author: Jack Doyle, jack@greensock.com
 */ let $,
  ee,
  We,
  ae,
  he,
  ve,
  _e,
  ue,
  R = "transform",
  Re = R + "Origin",
  ft,
  Xe = (t) => {
    let e = t.ownerDocument || t;
    for (
      !(R in t.style) &&
      ("msTransform" in t.style) &&
      ((R = "msTransform"), (Re = R + "Origin"));
      e.parentNode && (e = e.parentNode);

    );
    if (((ee = window), (_e = new K()), e)) {
      ($ = e),
        (We = e.documentElement),
        (ae = e.body),
        (ue = $.createElementNS("http://www.w3.org/2000/svg", "g")),
        (ue.style.transform = "none");
      let i = e.createElement("div"),
        s = e.createElement("div");
      ae.appendChild(i),
        i.appendChild(s),
        (i.style.position = "static"),
        (i.style[R] = "translate3d(0,0,1px)"),
        (ft = s.offsetParent !== i),
        ae.removeChild(i);
    }
    return e;
  },
  zt = (t) => {
    let e, i;
    for (; t && t !== ae; )
      (i = t._gsap),
        i && i.uncache && i.get(t, "x"),
        i &&
          !i.scaleX &&
          !i.scaleY &&
          i.renderTransform &&
          ((i.scaleX = i.scaleY = 1e-4),
          i.renderTransform(1, i),
          e ? e.push(i) : (e = [i])),
        (t = t.parentNode);
    return e;
  },
  mt = [],
  gt = [],
  Ue = () => ee.pageYOffset || $.scrollTop || We.scrollTop || ae.scrollTop || 0,
  qe = () =>
    ee.pageXOffset || $.scrollLeft || We.scrollLeft || ae.scrollLeft || 0,
  He = (t) =>
    t.ownerSVGElement || ((t.tagName + "").toLowerCase() === "svg" ? t : null),
  xt = (t) => {
    if (ee.getComputedStyle(t).position === "fixed") return !0;
    if (((t = t.parentNode), t && t.nodeType === 1)) return xt(t);
  },
  fe = (t, e) => {
    if (t.parentNode && ($ || Xe(t))) {
      let i = He(t),
        s = i
          ? i.getAttribute("xmlns") || "http://www.w3.org/2000/svg"
          : "http://www.w3.org/1999/xhtml",
        l = i ? (e ? "rect" : "g") : "div",
        n = e !== 2 ? 0 : 100,
        c = e === 3 ? 100 : 0,
        o =
          "position:absolute;display:block;pointer-events:none;margin:0;padding:0;",
        r = $.createElementNS
          ? $.createElementNS(s.replace(/^https/, "http"), l)
          : $.createElement(l);
      return (
        e &&
          (i
            ? (ve || (ve = fe(t)),
              r.setAttribute("width", 0.01),
              r.setAttribute("height", 0.01),
              r.setAttribute("transform", "translate(" + n + "," + c + ")"),
              ve.appendChild(r))
            : (he || ((he = fe(t)), (he.style.cssText = o)),
              (r.style.cssText =
                o +
                "width:0.1px;height:0.1px;top:" +
                c +
                "px;left:" +
                n +
                "px"),
              he.appendChild(r))),
        r
      );
    }
    throw "Need document and parent.";
  },
  Yt = (t) => {
    let e = new K(),
      i = 0;
    for (; i < t.numberOfItems; i++) e.multiply(t.getItem(i).matrix);
    return e;
  },
  wt = (t) => {
    let e = t.getCTM(),
      i;
    return (
      e ||
        ((i = t.style[R]),
        (t.style[R] = "none"),
        t.appendChild(ue),
        (e = ue.getCTM()),
        t.removeChild(ue),
        i
          ? (t.style[R] = i)
          : t.style.removeProperty(R.replace(/([A-Z])/g, "-$1").toLowerCase())),
      e || _e.clone()
    );
  },
  Wt = (t, e) => {
    let i = He(t),
      s = t === i,
      l = i ? mt : gt,
      n = t.parentNode,
      c,
      o,
      r,
      d,
      p,
      h;
    if (t === ee) return t;
    if (
      (l.length || l.push(fe(t, 1), fe(t, 2), fe(t, 3)), (c = i ? ve : he), i)
    )
      s
        ? ((r = wt(t)), (d = -r.e / r.a), (p = -r.f / r.d), (o = _e))
        : t.getBBox
        ? ((r = t.getBBox()),
          (o = t.transform ? t.transform.baseVal : {}),
          (o = o.numberOfItems
            ? o.numberOfItems > 1
              ? Yt(o)
              : o.getItem(0).matrix
            : _e),
          (d = o.a * r.x + o.c * r.y),
          (p = o.b * r.x + o.d * r.y))
        : ((o = new K()), (d = p = 0)),
        e && t.tagName.toLowerCase() === "g" && (d = p = 0),
        (s ? i : n).appendChild(c),
        c.setAttribute(
          "transform",
          "matrix(" +
            o.a +
            "," +
            o.b +
            "," +
            o.c +
            "," +
            o.d +
            "," +
            (o.e + d) +
            "," +
            (o.f + p) +
            ")"
        );
    else {
      if (((d = p = 0), ft))
        for (
          o = t.offsetParent, r = t;
          r && (r = r.parentNode) && r !== o && r.parentNode;

        )
          (ee.getComputedStyle(r)[R] + "").length > 4 &&
            ((d = r.offsetLeft), (p = r.offsetTop), (r = 0));
      if (
        ((h = ee.getComputedStyle(t)),
        h.position !== "absolute" && h.position !== "fixed")
      )
        for (o = t.offsetParent; n && n !== o; )
          (d += n.scrollLeft || 0), (p += n.scrollTop || 0), (n = n.parentNode);
      (r = c.style),
        (r.top = t.offsetTop - p + "px"),
        (r.left = t.offsetLeft - d + "px"),
        (r[R] = h[R]),
        (r[Re] = h[Re]),
        (r.position = h.position === "fixed" ? "fixed" : "absolute"),
        t.parentNode.appendChild(c);
    }
    return c;
  },
  Te = (t, e, i, s, l, n, c) => (
    (t.a = e), (t.b = i), (t.c = s), (t.d = l), (t.e = n), (t.f = c), t
  );
class K {
  constructor(e = 1, i = 0, s = 0, l = 1, n = 0, c = 0) {
    Te(this, e, i, s, l, n, c);
  }
  inverse() {
    let { a: e, b: i, c: s, d: l, e: n, f: c } = this,
      o = e * l - i * s || 1e-10;
    return Te(
      this,
      l / o,
      -i / o,
      -s / o,
      e / o,
      (s * c - l * n) / o,
      -(e * c - i * n) / o
    );
  }
  multiply(e) {
    let { a: i, b: s, c: l, d: n, e: c, f: o } = this,
      r = e.a,
      d = e.c,
      p = e.b,
      h = e.d,
      b = e.e,
      x = e.f;
    return Te(
      this,
      r * i + p * l,
      r * s + p * n,
      d * i + h * l,
      d * s + h * n,
      c + b * i + x * l,
      o + b * s + x * n
    );
  }
  clone() {
    return new K(this.a, this.b, this.c, this.d, this.e, this.f);
  }
  equals(e) {
    let { a: i, b: s, c: l, d: n, e: c, f: o } = this;
    return (
      i === e.a && s === e.b && l === e.c && n === e.d && c === e.e && o === e.f
    );
  }
  apply(e, i = {}) {
    let { x: s, y: l } = e,
      { a: n, b: c, c: o, d: r, e: d, f: p } = this;
    return (i.x = s * n + l * o + d || 0), (i.y = s * c + l * r + p || 0), i;
  }
}
function X(t, e, i, s) {
  if (!t || !t.parentNode || ($ || Xe(t)).documentElement === t) return new K();
  let l = zt(t),
    n = He(t),
    c = n ? mt : gt,
    o = Wt(t, i),
    r = c[0].getBoundingClientRect(),
    d = c[1].getBoundingClientRect(),
    p = c[2].getBoundingClientRect(),
    h = o.parentNode,
    b = !s && xt(t),
    x = new K(
      (d.left - r.left) / 100,
      (d.top - r.top) / 100,
      (p.left - r.left) / 100,
      (p.top - r.top) / 100,
      r.left + (b ? 0 : qe()),
      r.top + (b ? 0 : Ue())
    );
  if ((h.removeChild(o), l))
    for (r = l.length; r--; )
      (d = l[r]), (d.scaleX = d.scaleY = 0), d.renderTransform(1, d);
  return e ? x.inverse() : x;
}
/*!
 * Flip 3.12.2
 * https://greensock.com
 *
 * @license Copyright 2008-2023, GreenSock. All rights reserved.
 * Subject to the terms at https://greensock.com/standard-license or for
 * Club GreenSock members, the agreement issued with that membership.
 * @author: Jack Doyle, jack@greensock.com
 */ let Xt = 1,
  de,
  M,
  j,
  me,
  Q,
  G,
  Fe,
  st = (t, e) => t.actions.forEach((i) => i.vars[e] && i.vars[e](i)),
  ze = {},
  lt = 180 / Math.PI,
  Ut = Math.PI / 180,
  je = {},
  nt = {},
  Ne = {},
  $e = (t) => (typeof t == "string" ? t.split(" ").join("").split(",") : t),
  qt = $e("onStart,onUpdate,onComplete,onReverseComplete,onInterrupt"),
  Ee = $e(
    "transform,transformOrigin,width,height,position,top,left,opacity,zIndex,maxWidth,maxHeight,minWidth,minHeight"
  ),
  ge = (t) => de(t)[0] || console.warn("Element not found:", t),
  ne = (t) => Math.round(t * 1e4) / 1e4 || 0,
  Ve = (t, e, i) => t.forEach((s) => s.classList[i](e)),
  ot = {
    zIndex: 1,
    kill: 1,
    simple: 1,
    spin: 1,
    clearProps: 1,
    targets: 1,
    toggleClass: 1,
    onComplete: 1,
    onUpdate: 1,
    onInterrupt: 1,
    onStart: 1,
    delay: 1,
    repeat: 1,
    repeatDelay: 1,
    yoyo: 1,
    scale: 1,
    fade: 1,
    absolute: 1,
    props: 1,
    onEnter: 1,
    onLeave: 1,
    custom: 1,
    paused: 1,
    nested: 1,
    prune: 1,
    absoluteOnLeave: 1,
  },
  bt = {
    zIndex: 1,
    simple: 1,
    clearProps: 1,
    scale: 1,
    absolute: 1,
    fitChild: 1,
    getVars: 1,
    props: 1,
  },
  yt = (t) => t.replace(/([A-Z])/g, "-$1").toLowerCase(),
  oe = (t, e) => {
    let i = {},
      s;
    for (s in t) e[s] || (i[s] = t[s]);
    return i;
  },
  Ge = {},
  vt = (t) => {
    let e = (Ge[t] = $e(t));
    return (Ne[t] = e.concat(Ee)), e;
  },
  Ht = (t) => {
    let e = t._gsap || M.core.getCache(t);
    return e.gmCache === M.ticker.frame
      ? e.gMatrix
      : ((e.gmCache = M.ticker.frame), (e.gMatrix = X(t, !0, !1, !0)));
  },
  _t = (t, e, i = 0) => {
    let s = t.parentNode,
      l = 1e3 * 10 ** i * (e ? -1 : 1),
      n = e ? -l * 900 : 0;
    for (; t; ) (n += l), (t = t.previousSibling);
    return s ? n + _t(s, e, i + 1) : n;
  },
  ke = (t, e, i) => (
    t.forEach((s) => (s.d = _t(i ? s.element : s.t, e))),
    t.sort((s, l) => s.d - l.d),
    t
  ),
  xe = (t, e) => {
    let i = t.element.style,
      s = (t.css = t.css || []),
      l = e.length,
      n,
      c;
    for (; l--; )
      (n = e[l]),
        (c = i[n] || i.getPropertyValue(n)),
        s.push(c ? n : nt[n] || (nt[n] = yt(n)), c);
    return i;
  },
  Ke = (t) => {
    let e = t.css,
      i = t.element.style,
      s = 0;
    for (t.cache.uncache = 1; s < e.length; s += 2)
      e[s + 1] ? (i[e[s]] = e[s + 1]) : i.removeProperty(e[s]);
    !e[e.indexOf("transform") + 1] &&
      i.translate &&
      (i.removeProperty("translate"),
      i.removeProperty("scale"),
      i.removeProperty("rotate"));
  },
  rt = (t, e) => {
    t.forEach((i) => (i.a.cache.uncache = 1)), e || t.finalStates.forEach(Ke);
  },
  Ie =
    "paddingTop,paddingRight,paddingBottom,paddingLeft,gridArea,transition".split(
      ","
    ),
  Ze = (t, e, i) => {
    let { element: s, width: l, height: n, uncache: c, getProp: o } = t,
      r = s.style,
      d = 4,
      p,
      h,
      b;
    if ((typeof e != "object" && (e = t), j && i !== 1))
      return (
        j._abs.push({ t: s, b: t, a: t, sd: 0 }),
        j._final.push(() => (t.cache.uncache = 1) && Ke(t)),
        s
      );
    for (
      h = o("display") === "none",
        (!t.isVisible || h) &&
          (h && (xe(t, ["display"]).display = e.display),
          (t.matrix = e.matrix),
          (t.width = l = t.width || e.width),
          (t.height = n = t.height || e.height)),
        xe(t, Ie),
        b = window.getComputedStyle(s);
      d--;

    )
      r[Ie[d]] = b[Ie[d]];
    if (
      ((r.gridArea = "1 / 1 / 1 / 1"),
      (r.transition = "none"),
      (r.position = "absolute"),
      (r.width = l + "px"),
      (r.height = n + "px"),
      r.top || (r.top = "0px"),
      r.left || (r.left = "0px"),
      c)
    )
      p = new te(s);
    else if (((p = oe(t, je)), (p.position = "absolute"), t.simple)) {
      let x = s.getBoundingClientRect();
      p.matrix = new K(1, 0, 0, 1, x.left + qe(), x.top + Ue());
    } else p.matrix = X(s, !1, !1, !0);
    return (p = ce(p, t, !0)), (t.x = G(p.x, 0.01)), (t.y = G(p.y, 0.01)), s;
  },
  at = (t, e) => (
    e !== !0 &&
      ((e = de(e)),
      (t = t.filter((i) => {
        if (e.indexOf((i.sd < 0 ? i.b : i.a).element) !== -1) return !0;
        i.t._gsap.renderTransform(1),
          i.b.isVisible &&
            ((i.t.style.width = i.b.width + "px"),
            (i.t.style.height = i.b.height + "px"));
      }))),
    t
  ),
  jt = (t) =>
    ke(t, !0).forEach(
      (e) =>
        (e.a.isVisible || e.b.isVisible) && Ze(e.sd < 0 ? e.b : e.a, e.b, 1)
    ),
  $t = (t, e) => (e && t.idLookup[Ye(e).id]) || t.elementStates[0],
  Ye = (t, e, i, s) =>
    t instanceof te
      ? t
      : t instanceof z
      ? $t(t, s)
      : new te(
          typeof t == "string" ? ge(t) || console.warn(t + " not found") : t,
          e,
          i
        ),
  Gt = (t, e) => {
    let i = M.getProperty(t.element, null, "native"),
      s = (t.props = {}),
      l = e.length;
    for (; l--; ) s[e[l]] = (i(e[l]) + "").trim();
    return s.zIndex && (s.zIndex = parseFloat(s.zIndex) || 0), t;
  },
  kt = (t, e) => {
    let i = t.style || t,
      s;
    for (s in e) i[s] = e[s];
  },
  Kt = (t) => {
    let e = t.getAttribute("data-flip-id");
    return e || t.setAttribute("data-flip-id", (e = "auto-" + Xt++)), e;
  },
  Nt = (t) => t.map((e) => e.element),
  ct = (t, e, i) => t && e.length && i.add(t(Nt(e), i, new z(e, 0, !0)), 0),
  ce = (t, e, i, s, l, n) => {
    let { element: c, cache: o, parent: r, x: d, y: p } = t,
      { width: h, height: b, scaleX: x, scaleY: f, rotation: u, bounds: k } = e,
      m = n && Fe && Fe(c, "transform"),
      v = t,
      { e: L, f: V } = e.matrix,
      O =
        t.bounds.width !== k.width ||
        t.bounds.height !== k.height ||
        t.scaleX !== x ||
        t.scaleY !== f ||
        t.rotation !== u,
      Z = !O && t.simple && e.simple && !l,
      P,
      _,
      E,
      U,
      F,
      I,
      w;
    return (
      Z || !r
        ? ((x = f = 1), (u = P = 0))
        : ((F = Ht(r)),
          (I = F.clone().multiply(
            e.ctm ? e.matrix.clone().multiply(e.ctm) : e.matrix
          )),
          (u = ne(Math.atan2(I.b, I.a) * lt)),
          (P = ne(Math.atan2(I.c, I.d) * lt + u) % 360),
          (x = Math.sqrt(I.a ** 2 + I.b ** 2)),
          (f = Math.sqrt(I.c ** 2 + I.d ** 2) * Math.cos(P * Ut)),
          l &&
            ((l = de(l)[0]),
            (U = M.getProperty(l)),
            (w = l.getBBox && typeof l.getBBox == "function" && l.getBBox()),
            (v = {
              scaleX: U("scaleX"),
              scaleY: U("scaleY"),
              width: w ? w.width : Math.ceil(parseFloat(U("width", "px"))),
              height: w ? w.height : parseFloat(U("height", "px")),
            })),
          (o.rotation = u + "deg"),
          (o.skewX = P + "deg")),
      i
        ? ((x *= h === v.width || !v.width ? 1 : h / v.width),
          (f *= b === v.height || !v.height ? 1 : b / v.height),
          (o.scaleX = x),
          (o.scaleY = f))
        : ((h = G((h * x) / v.scaleX, 0)),
          (b = G((b * f) / v.scaleY, 0)),
          (c.style.width = h + "px"),
          (c.style.height = b + "px")),
      s && kt(c, e.props),
      Z || !r
        ? ((d += L - t.matrix.e), (p += V - t.matrix.f))
        : O || r !== e.parent
        ? (o.renderTransform(1, o),
          (I = X(l || c, !1, !1, !0)),
          (_ = F.apply({ x: I.e, y: I.f })),
          (E = F.apply({ x: L, y: V })),
          (d += E.x - _.x),
          (p += E.y - _.y))
        : ((F.e = F.f = 0),
          (E = F.apply({ x: L - t.matrix.e, y: V - t.matrix.f })),
          (d += E.x),
          (p += E.y)),
      (d = G(d, 0.02)),
      (p = G(p, 0.02)),
      n && !(n instanceof te)
        ? m && m.revert()
        : ((o.x = d + "px"), (o.y = p + "px"), o.renderTransform(1, o)),
      n &&
        ((n.x = d),
        (n.y = p),
        (n.rotation = u),
        (n.skewX = P),
        i ? ((n.scaleX = x), (n.scaleY = f)) : ((n.width = h), (n.height = b))),
      n || o
    );
  },
  Be = (t, e) => (t instanceof z ? t : new z(t, e)),
  Et = (t, e, i) => {
    let s = t.idLookup[i],
      l = t.alt[i];
    return l.isVisible &&
      (!(e.getElementState(l.element) || l).isVisible || !s.isVisible)
      ? l
      : s;
  },
  Me = [],
  Oe = "width,height,overflowX,overflowY".split(","),
  be,
  dt = (t) => {
    if (t !== be) {
      let e = Q.style,
        i = Q.clientWidth === window.outerWidth,
        s = Q.clientHeight === window.outerHeight,
        l = 4;
      if (t && (i || s)) {
        for (; l--; ) Me[l] = e[Oe[l]];
        i && ((e.width = Q.clientWidth + "px"), (e.overflowY = "hidden")),
          s && ((e.height = Q.clientHeight + "px"), (e.overflowX = "hidden")),
          (be = t);
      } else if (be) {
        for (; l--; ) Me[l] ? (e[Oe[l]] = Me[l]) : e.removeProperty(yt(Oe[l]));
        be = t;
      }
    }
  },
  De = (t, e, i, s) => {
    (t instanceof z && e instanceof z) ||
      console.warn("Not a valid state object."),
      (i = i || {});
    let {
        clearProps: l,
        onEnter: n,
        onLeave: c,
        absolute: o,
        absoluteOnLeave: r,
        custom: d,
        delay: p,
        paused: h,
        repeat: b,
        repeatDelay: x,
        yoyo: f,
        toggleClass: u,
        nested: k,
        zIndex: m,
        scale: v,
        fade: L,
        stagger: V,
        spin: O,
        prune: Z,
      } = i,
      P = ("props" in i ? i : t).props,
      _ = oe(i, ot),
      E = M.timeline({
        delay: p,
        paused: h,
        repeat: b,
        repeatDelay: x,
        yoyo: f,
        data: "isFlip",
      }),
      U = _,
      F = [],
      I = [],
      w = [],
      we = [],
      Pt = O === !0 ? 1 : O || 0,
      Ct = typeof O == "function" ? O : () => Pt,
      Se = t.interrupted || e.interrupted,
      Qe = E[s !== 1 ? "to" : "from"],
      se,
      A,
      et,
      J,
      T,
      S,
      le,
      Y,
      Le,
      q,
      H,
      Pe,
      C,
      B;
    for (A in e.idLookup)
      (H = e.alt[A] ? Et(e, t, A) : e.idLookup[A]),
        (T = H.element),
        (q = t.idLookup[A]),
        t.alt[A] &&
          T === q.element &&
          (t.alt[A].isVisible || !H.isVisible) &&
          (q = t.alt[A]),
        q
          ? ((S = {
              t: T,
              b: q,
              a: H,
              sd: q.element === T ? 0 : H.isVisible ? 1 : -1,
            }),
            w.push(S),
            S.sd &&
              (S.sd < 0 && ((S.b = H), (S.a = q)),
              Se && xe(S.b, P ? Ne[P] : Ee),
              L &&
                w.push(
                  (S.swap = {
                    t: q.element,
                    b: S.b,
                    a: S.a,
                    sd: -S.sd,
                    swap: S,
                  })
                )),
            (T._flip = q.element._flip = j ? j.timeline : E))
          : H.isVisible &&
            (w.push({
              t: T,
              b: oe(H, { isVisible: 1 }),
              a: H,
              sd: 0,
              entering: 1,
            }),
            (T._flip = j ? j.timeline : E));
    P && (Ge[P] || vt(P)).forEach((D) => (_[D] = (pe) => w[pe].a.props[D])),
      (w.finalStates = Le = []),
      (Pe = () => {
        for (ke(w), dt(!0), J = 0; J < w.length; J++)
          (S = w[J]),
            (C = S.a),
            (B = S.b),
            Z && !C.isDifferent(B) && !S.entering
              ? w.splice(J--, 1)
              : ((T = S.t),
                k && !(S.sd < 0) && J && (C.matrix = X(T, !1, !1, !0)),
                B.isVisible && C.isVisible
                  ? (S.sd < 0
                      ? ((le = new te(T, P, t.simple)),
                        ce(le, C, v, 0, 0, le),
                        (le.matrix = X(T, !1, !1, !0)),
                        (le.css = S.b.css),
                        (S.a = C = le),
                        L && (T.style.opacity = Se ? B.opacity : C.opacity),
                        V && we.push(T))
                      : S.sd > 0 &&
                        L &&
                        (T.style.opacity = Se ? C.opacity - B.opacity : "0"),
                    ce(C, B, v, P))
                  : B.isVisible !== C.isVisible &&
                    (B.isVisible
                      ? C.isVisible ||
                        ((B.css = C.css),
                        I.push(B),
                        w.splice(J--, 1),
                        o && k && ce(C, B, v, P))
                      : (C.isVisible && F.push(C), w.splice(J--, 1))),
                v ||
                  ((T.style.maxWidth = Math.max(C.width, B.width) + "px"),
                  (T.style.maxHeight = Math.max(C.height, B.height) + "px"),
                  (T.style.minWidth = Math.min(C.width, B.width) + "px"),
                  (T.style.minHeight = Math.min(C.height, B.height) + "px")),
                k && u && T.classList.add(u)),
            Le.push(C);
        let D;
        if (
          (u &&
            ((D = Le.map((g) => g.element)),
            k && D.forEach((g) => g.classList.remove(u))),
          dt(!1),
          v
            ? ((_.scaleX = (g) => w[g].a.scaleX),
              (_.scaleY = (g) => w[g].a.scaleY))
            : ((_.width = (g) => w[g].a.width + "px"),
              (_.height = (g) => w[g].a.height + "px"),
              (_.autoRound = i.autoRound || !1)),
          (_.x = (g) => w[g].a.x + "px"),
          (_.y = (g) => w[g].a.y + "px"),
          (_.rotation = (g) =>
            w[g].a.rotation + (O ? Ct(g, Y[g], Y) * 360 : 0)),
          (_.skewX = (g) => w[g].a.skewX),
          (Y = w.map((g) => g.t)),
          (m || m === 0) &&
            ((_.modifiers = { zIndex: () => m }),
            (_.zIndex = m),
            (_.immediateRender = i.immediateRender !== !1)),
          L &&
            (_.opacity = (g) =>
              w[g].sd < 0 ? 0 : w[g].sd > 0 ? w[g].a.opacity : "+=0"),
          we.length)
        ) {
          V = M.utils.distribute(V);
          let g = Y.slice(we.length);
          _.stagger = (tt, it) =>
            V(~we.indexOf(it) ? Y.indexOf(w[tt].swap.t) : tt, it, g);
        }
        if (
          (qt.forEach((g) => i[g] && E.eventCallback(g, i[g], i[g + "Params"])),
          d && Y.length)
        ) {
          (U = oe(_, ot)),
            "scale" in d && ((d.scaleX = d.scaleY = d.scale), delete d.scale);
          for (A in d)
            (se = oe(d[A], bt)),
              (se[A] = _[A]),
              !("duration" in se) &&
                "duration" in _ &&
                (se.duration = _.duration),
              (se.stagger = _.stagger),
              Qe.call(E, Y, se, 0),
              delete U[A];
        }
        (Y.length || I.length || F.length) &&
          (u &&
            E.add(() => Ve(D, u, E._zTime < 0 ? "remove" : "add"), 0) &&
            !h &&
            Ve(D, u, "add"),
          Y.length && Qe.call(E, Y, U, 0)),
          ct(n, F, E),
          ct(c, I, E);
        let pe = j && j.timeline;
        pe && (pe.add(E, 0), j._final.push(() => rt(w, !l))),
          (et = E.duration()),
          E.call(() => {
            let g = E.time() >= et;
            g && !pe && rt(w, !l), u && Ve(D, u, g ? "remove" : "add");
          });
      }),
      r &&
        (o = w
          .filter((D) => !D.sd && !D.a.isVisible && D.b.isVisible)
          .map((D) => D.a.element)),
      j
        ? (o && j._abs.push(...at(w, o)), j._run.push(Pe))
        : (o && jt(at(w, o)), Pe());
    let Ce = j ? j.timeline : E;
    return (Ce.revert = () => Je(Ce, 1, 1)), Ce;
  },
  St = (t) => {
    t.vars.onInterrupt &&
      t.vars.onInterrupt.apply(t, t.vars.onInterruptParams || []),
      t.getChildren(!0, !1, !0).forEach(St);
  },
  Je = (t, e, i) => {
    if (t && t.progress() < 1 && (!t.paused() || i))
      return e && (St(t), e < 2 && t.progress(1), t.kill()), !0;
  },
  ye = (t) => {
    let e = (t.idLookup = {}),
      i = (t.alt = {}),
      s = t.elementStates,
      l = s.length,
      n;
    for (; l--; ) (n = s[l]), e[n.id] ? (i[n.id] = n) : (e[n.id] = n);
  };
class z {
  constructor(e, i, s) {
    if (((this.props = i && i.props), (this.simple = !!(i && i.simple)), s))
      (this.targets = Nt(e)), (this.elementStates = e), ye(this);
    else {
      this.targets = de(e);
      let l = i && (i.kill === !1 || (i.batch && !i.kill));
      j && !l && j._kill.push(this), this.update(l || !!j);
    }
  }
  update(e) {
    return (
      (this.elementStates = this.targets.map(
        (i) => new te(i, this.props, this.simple)
      )),
      ye(this),
      this.interrupt(e),
      this.recordInlineStyles(),
      this
    );
  }
  clear() {
    return (
      (this.targets.length = this.elementStates.length = 0), ye(this), this
    );
  }
  fit(e, i, s) {
    let l = ke(this.elementStates.slice(0), !1, !0),
      n = (e || this).idLookup,
      c = 0,
      o,
      r;
    for (; c < l.length; c++)
      (o = l[c]),
        s && (o.matrix = X(o.element, !1, !1, !0)),
        (r = n[o.id]),
        r && ce(o, r, i, !0, 0, o),
        (o.matrix = X(o.element, !1, !1, !0));
    return this;
  }
  getProperty(e, i) {
    let s = this.getElementState(e) || je;
    return (i in s ? s : s.props || je)[i];
  }
  add(e) {
    let i = e.targets.length,
      s = this.idLookup,
      l = this.alt,
      n,
      c,
      o;
    for (; i--; )
      (c = e.elementStates[i]),
        (o = s[c.id]),
        o &&
        (c.element === o.element || (l[c.id] && l[c.id].element === c.element))
          ? ((n = this.elementStates.indexOf(
              c.element === o.element ? o : l[c.id]
            )),
            this.targets.splice(n, 1, e.targets[i]),
            this.elementStates.splice(n, 1, c))
          : (this.targets.push(e.targets[i]), this.elementStates.push(c));
    return (
      e.interrupted && (this.interrupted = !0),
      e.simple || (this.simple = !1),
      ye(this),
      this
    );
  }
  compare(e) {
    let i = e.idLookup,
      s = this.idLookup,
      l = [],
      n = [],
      c = [],
      o = [],
      r = [],
      d = e.alt,
      p = this.alt,
      h = (O, Z, P) =>
        (O.isVisible !== Z.isVisible
          ? O.isVisible
            ? c
            : o
          : O.isVisible
          ? n
          : l
        ).push(P) && r.push(P),
      b = (O, Z, P) => r.indexOf(P) < 0 && h(O, Z, P),
      x,
      f,
      u,
      k,
      m,
      v,
      L,
      V;
    for (u in i)
      (m = d[u]),
        (v = p[u]),
        (x = m ? Et(e, this, u) : i[u]),
        (k = x.element),
        (f = s[u]),
        v
          ? ((V = f.isVisible || (!v.isVisible && k === f.element) ? f : v),
            (L =
              m && !x.isVisible && !m.isVisible && V.element === m.element
                ? m
                : x),
            L.isVisible && V.isVisible && L.element !== V.element
              ? ((L.isDifferent(V) ? n : l).push(L.element, V.element),
                r.push(L.element, V.element))
              : h(L, V, L.element),
            m && L.element === m.element && (m = i[u]),
            b(L.element !== f.element && m ? m : L, f, f.element),
            b(m && m.element === v.element ? m : L, v, v.element),
            m && b(m, v.element === m.element ? v : f, m.element))
          : (f ? (f.isDifferent(x) ? h(x, f, k) : l.push(k)) : c.push(k),
            m && b(m, f, m.element));
    for (u in s) i[u] || (o.push(s[u].element), p[u] && o.push(p[u].element));
    return { changed: n, unchanged: l, enter: c, leave: o };
  }
  recordInlineStyles() {
    let e = Ne[this.props] || Ee,
      i = this.elementStates.length;
    for (; i--; ) xe(this.elementStates[i], e);
  }
  interrupt(e) {
    let i = [];
    this.targets.forEach((s) => {
      let l = s._flip,
        n = Je(l, e ? 0 : 1);
      e && n && i.indexOf(l) < 0 && l.add(() => this.updateVisibility()),
        n && i.push(l);
    }),
      !e && i.length && this.updateVisibility(),
      this.interrupted || (this.interrupted = !!i.length);
  }
  updateVisibility() {
    this.elementStates.forEach((e) => {
      let i = e.element.getBoundingClientRect();
      (e.isVisible = !!(i.width || i.height || i.top || i.left)),
        (e.uncache = 1);
    });
  }
  getElementState(e) {
    return this.elementStates[this.targets.indexOf(ge(e))];
  }
  makeAbsolute() {
    return ke(this.elementStates.slice(0), !0, !0).map(Ze);
  }
}
class te {
  constructor(e, i, s) {
    (this.element = e), this.update(i, s);
  }
  isDifferent(e) {
    let i = this.bounds,
      s = e.bounds;
    return (
      i.top !== s.top ||
      i.left !== s.left ||
      i.width !== s.width ||
      i.height !== s.height ||
      !this.matrix.equals(e.matrix) ||
      this.opacity !== e.opacity ||
      (this.props &&
        e.props &&
        JSON.stringify(this.props) !== JSON.stringify(e.props))
    );
  }
  update(e, i) {
    let s = this,
      l = s.element,
      n = M.getProperty(l),
      c = M.core.getCache(l),
      o = l.getBoundingClientRect(),
      r =
        l.getBBox &&
        typeof l.getBBox == "function" &&
        l.nodeName.toLowerCase() !== "svg" &&
        l.getBBox(),
      d = i ? new K(1, 0, 0, 1, o.left + qe(), o.top + Ue()) : X(l, !1, !1, !0);
    (s.getProp = n),
      (s.element = l),
      (s.id = Kt(l)),
      (s.matrix = d),
      (s.cache = c),
      (s.bounds = o),
      (s.isVisible = !!(o.width || o.height || o.left || o.top)),
      (s.display = n("display")),
      (s.position = n("position")),
      (s.parent = l.parentNode),
      (s.x = n("x")),
      (s.y = n("y")),
      (s.scaleX = c.scaleX),
      (s.scaleY = c.scaleY),
      (s.rotation = n("rotation")),
      (s.skewX = n("skewX")),
      (s.opacity = n("opacity")),
      (s.width = r ? r.width : G(n("width", "px"), 0.04)),
      (s.height = r ? r.height : G(n("height", "px"), 0.04)),
      e && Gt(s, Ge[e] || vt(e)),
      (s.ctm =
        l.getCTM && l.nodeName.toLowerCase() === "svg" && wt(l).inverse()),
      (s.simple =
        i || (ne(d.a) === 1 && !ne(d.b) && !ne(d.c) && ne(d.d) === 1)),
      (s.uncache = 0);
  }
}
class Zt {
  constructor(e, i) {
    (this.vars = e),
      (this.batch = i),
      (this.states = []),
      (this.timeline = i.timeline);
  }
  getStateById(e) {
    let i = this.states.length;
    for (; i--; ) if (this.states[i].idLookup[e]) return this.states[i];
  }
  kill() {
    this.batch.remove(this);
  }
}
class Jt {
  constructor(e) {
    (this.id = e),
      (this.actions = []),
      (this._kill = []),
      (this._final = []),
      (this._abs = []),
      (this._run = []),
      (this.data = {}),
      (this.state = new z()),
      (this.timeline = M.timeline());
  }
  add(e) {
    let i = this.actions.filter((s) => s.vars === e);
    return i.length
      ? i[0]
      : ((i = new Zt(typeof e == "function" ? { animate: e } : e, this)),
        this.actions.push(i),
        i);
  }
  remove(e) {
    let i = this.actions.indexOf(e);
    return i >= 0 && this.actions.splice(i, 1), this;
  }
  getState(e) {
    let i = j,
      s = me;
    return (
      (j = this),
      this.state.clear(),
      (this._kill.length = 0),
      this.actions.forEach((l) => {
        l.vars.getState &&
          ((l.states.length = 0), (me = l), (l.state = l.vars.getState(l))),
          e && l.states.forEach((n) => this.state.add(n));
      }),
      (me = s),
      (j = i),
      this.killConflicts(),
      this
    );
  }
  animate() {
    let e = j,
      i = this.timeline,
      s = this.actions.length,
      l,
      n;
    for (
      j = this,
        i.clear(),
        this._abs.length = this._final.length = this._run.length = 0,
        this.actions.forEach((c) => {
          c.vars.animate && c.vars.animate(c);
          let o = c.vars.onEnter,
            r = c.vars.onLeave,
            d = c.targets,
            p,
            h;
          d &&
            d.length &&
            (o || r) &&
            ((p = new z()),
            c.states.forEach((b) => p.add(b)),
            (h = p.compare(ie.getState(d))),
            h.enter.length && o && o(h.enter),
            h.leave.length && r && r(h.leave));
        }),
        jt(this._abs),
        this._run.forEach((c) => c()),
        n = i.duration(),
        l = this._final.slice(0),
        i.add(() => {
          n <= i.time() && (l.forEach((c) => c()), st(this, "onComplete"));
        }),
        j = e;
      s--;

    )
      this.actions[s].vars.once && this.actions[s].kill();
    return st(this, "onStart"), i.restart(), this;
  }
  loadState(e) {
    e || (e = () => 0);
    let i = [];
    return (
      this.actions.forEach((s) => {
        if (s.vars.loadState) {
          let l,
            n = (c) => {
              c && (s.targets = c),
                (l = i.indexOf(n)),
                ~l && (i.splice(l, 1), i.length || e());
            };
          i.push(n), s.vars.loadState(n);
        }
      }),
      i.length || e(),
      this
    );
  }
  setState() {
    return (
      this.actions.forEach(
        (e) => (e.targets = e.vars.setState && e.vars.setState(e))
      ),
      this
    );
  }
  killConflicts(e) {
    return (
      this.state.interrupt(e), this._kill.forEach((i) => i.interrupt(e)), this
    );
  }
  run(e, i) {
    return (
      this !== j &&
        (e || this.getState(i),
        this.loadState(() => {
          this._killed || (this.setState(), this.animate());
        })),
      this
    );
  }
  clear(e) {
    this.state.clear(), e || (this.actions.length = 0);
  }
  getStateById(e) {
    let i = this.actions.length,
      s;
    for (; i--; ) if (((s = this.actions[i].getStateById(e)), s)) return s;
    return this.state.idLookup[e] && this.state;
  }
  kill() {
    (this._killed = 1), this.clear(), delete ze[this.id];
  }
}
class ie {
  static getState(e, i) {
    let s = Be(e, i);
    return (
      me && me.states.push(s), i && i.batch && ie.batch(i.batch).state.add(s), s
    );
  }
  static from(e, i) {
    return (
      (i = i || {}),
      "clearProps" in i || (i.clearProps = !0),
      De(
        e,
        Be(i.targets || e.targets, {
          props: i.props || e.props,
          simple: i.simple,
          kill: !!i.kill,
        }),
        i,
        -1
      )
    );
  }
  static to(e, i) {
    return De(
      e,
      Be(i.targets || e.targets, {
        props: i.props || e.props,
        simple: i.simple,
        kill: !!i.kill,
      }),
      i,
      1
    );
  }
  static fromTo(e, i, s) {
    return De(e, i, s);
  }
  static fit(e, i, s) {
    let l = s ? oe(s, bt) : {},
      {
        absolute: n,
        scale: c,
        getVars: o,
        props: r,
        runBackwards: d,
        onComplete: p,
        simple: h,
      } = s || l,
      b = s && s.fitChild && ge(s.fitChild),
      x = Ye(i, r, h, e),
      f = Ye(e, 0, h, x),
      u = r ? Ne[r] : Ee;
    return (
      r && kt(l, x.props),
      d &&
        (xe(f, u),
        "immediateRender" in l || (l.immediateRender = !0),
        (l.onComplete = function () {
          Ke(f), p && p.apply(this, arguments);
        })),
      n && Ze(f, x),
      (l = ce(f, x, c || b, r, b, l.duration || o ? l : 0)),
      o ? l : l.duration ? M.to(f.element, l) : null
    );
  }
  static makeAbsolute(e, i) {
    return (e instanceof z ? e : new z(e, i)).makeAbsolute();
  }
  static batch(e) {
    return e || (e = "default"), ze[e] || (ze[e] = new Jt(e));
  }
  static killFlipsOf(e, i) {
    (e instanceof z ? e.targets : de(e)).forEach(
      (s) => s && Je(s._flip, i !== !1 ? 1 : 2)
    );
  }
  static isFlipping(e) {
    let i = ie.getByTarget(e);
    return !!i && i.isActive();
  }
  static getByTarget(e) {
    return (ge(e) || je)._flip;
  }
  static getElementState(e, i) {
    return new te(ge(e), i);
  }
  static convertCoordinates(e, i, s) {
    let l = X(i, !0, !0).multiply(X(e));
    return s ? l.apply(s) : l;
  }
  static register(e) {
    if (((Q = typeof document < "u" && document.body), Q)) {
      (M = e), Xe(Q), (de = M.utils.toArray), (Fe = M.core.getStyleSaver);
      let i = M.utils.snap(0.1);
      G = (s, l) => i(parseFloat(s) + l);
    }
  }
}
ie.version = "3.12.2";
typeof window < "u" && window.gsap && window.gsap.registerPlugin(ie);
const Qt = ({ urls: t, type: e }) => {
    const i = window.matchMedia("(min-width: 768px)").matches,
      [s, l] = N.useState(t.desktop);
    return (
      N.useEffect(() => {
        if (e === W.VIDEO_FROM_MEDIA) {
          const n = i
            ? t.media_videos.desktop_video
            : t.media_videos.mobile_video;
          l(n);
          return;
        }
        if (e === W.UPLOAD_FROM_LINK) {
          const n = i ? t.url_videos.desktop_video : t.url_videos.mobile_video;
          l(n);
          return;
        }
      }, [window.innerWidth]),
      a.jsx("section", {
        className: "video-banner",
        children: a.jsxs("video", {
          title: "Banner Video",
          src: s,
          loop: !0,
          muted: !0,
          playsInline: !0,
          autoPlay: !0,
          preload: "auto",
          children: [
            a.jsx("source", { src: s, type: "video/mp4" }),
            a.jsx("source", { src: s, type: "video/webp" }),
            "Your browser does not support the video tag.",
          ],
        }),
      })
    );
  },
  ei = ({ children: t }) => (
    N.useLayoutEffect(() => {
      const e = y.matchMedia(),
        i = document.querySelector("#work-container"),
        s = document.querySelector("#work-title");
      if (!i || !s) return;
      const l =
          (s == null ? void 0 : s.clientWidth) -
          (i == null ? void 0 : i.clientWidth),
        n = y.context(() => {
          e.add("(max-width: 535px)", () => {
            y.to("#work-title", {
              scrollTrigger: {
                trigger: "#work-title",
                start: "-310px 45%",
                end: "bottom 45%",
                scrub: !0,
              },
              x: () => -l,
              ease: Bt.easeInOut,
            });
          });
        });
      return () => n.revert();
    }, []),
    N.useLayoutEffect(() => {
      const e = y.context(() => {
        y.timeline().to(
          "#video-section",
          {
            scrollTrigger: {
              trigger: "#video-section",
              invalidateOnRefresh: !1,
              pin: !0,
              pinSpacing: !1,
            },
          },
          "a"
        );
      });
      return () => e.revert();
    }, []),
    a.jsx("div", { className: "parallax-container", children: t })
  ),
  ti = ({ isShortDescriptionActive: t, data: e }) => (
    y.registerPlugin(ht),
    N.useLayoutEffect(() => {
      const i = y.context(() => {
        const s = y.timeline({
          defaults: { ease: "power1.out", duration: 0.8 },
          scrollTrigger: {
            trigger: "#short-description-container",
            start: "20% top",
            end: "bottom 20%",
            scrub: !0,
            toggleActions: "play none none reverse",
            invalidateOnRefresh: !0,
          },
        });
        s.to("#short-description__info", { xPercent: -100 }, "a"),
          s.to("#short-description__image", { xPercent: 100 }, "a"),
          s.to(
            "#short-description-section",
            {
              scrollTrigger: {
                trigger: "#short-description-section",
                start: t ? "top top" : "30% top",
                end: t ? "top top" : "bottom 5%",
                invalidateOnRefresh: !1,
                pin: !0,
                pinSpacing: !1,
              },
            },
            "a"
          );
      });
      return () => i.revert();
    }, [t]),
    a.jsxs("section", {
      id: "short-description-section",
      children: [
        a.jsx("div", {
          className: "BlackUpperCircle",
          children: a.jsx(ut, {
            interiorBackground: "#bb0c2b",
            containerBackground: "transparent",
          }),
        }),
        a.jsxs("section", {
          id: "short-description-container",
          className: "short-description-container ",
          children: [
            a.jsx("div", {
              id: "short-description__info",
              className: "short-description__info",
              children: a.jsxs("div", {
                className: "description",
                children: [a.jsx("h2", { children: e.description_title })],
              }),
            }),
            a.jsx("div", {
              id: "short-description__image",
              className: "short-description__image",
              children: a.jsx("img", {
                src: e.description_image.url,
                alt: e.description_image.alt,
                className: "rounded-full w-ful h-full",
              }),
            }),
          ],
        }),
      ],
    })
  ),
  ii = ({ srcs: t, type: e }) =>
    e === W.IMAGE
      ? a.jsx("img", {
          src: t.image.url,
          alt: t.image.alt,
          className: "w-full h-full object-cover",
        })
      : e === W.YOUTUBE
      ? a.jsx("iframe", {
          id: "work-item-video",
          src: `${t.youtube}`,
          title: "YouTube video player",
          allowFullScreen: !0,
          className: "absolute top-0 left-0 w-full h-full rounded-[16px]",
        })
      : a.jsxs("video", {
          loop: !0,
          muted: !0,
          playsInline: !0,
          autoPlay: !0,
          className: "w-full h-full object-cover",
          children: [
            a.jsx("source", { src: t.video, type: "video/mp4" }),
            a.jsx("source", { src: t.video, type: "video/webm" }),
            "Your browser does not support the video tag.",
          ],
        }),
  Lt = ({ item: t, onClick: e }) => {
    const [i, s] = N.useState(window.innerWidth);
    return (
      N.useLayoutEffect(() => {
        const l = y.matchMedia(),
          n = document.querySelectorAll(".work-item"),
          c = document.querySelectorAll(".work-item__video"),
          o = y.context(() => {
            l.add("(min-width: 1023px)", () => {
              y.set(c, { display: "none", opacity: 0 }),
                n.forEach((r) => {
                  const d = r.querySelector(".work-item__video"),
                    p = d.querySelector("iframe");
                  r.addEventListener("mouseover", () => {
                    if (
                      (y.fromTo(
                        d,
                        { display: "none", opacity: 0 },
                        { display: "flex", opacity: 1, duration: 0.5 }
                      ),
                      t.type_of_video === W.YOUTUBE &&
                        t.type_of_video === W.UPLOAD_FROM_LINK)
                    )
                      if (p) {
                        if (p.src.includes("?autoplay=1&mute=1")) return;
                        p.src += "?autoplay=1&mute=1";
                      } else r.querySelector("video").play();
                  }),
                    r.addEventListener("mouseout", () => {
                      y.to(d, { display: "none", opacity: 0, duration: 0.5 }),
                        t.type_of_video === W.YOUTUBE &&
                          t.type_of_video === W.UPLOAD_FROM_LINK &&
                          (p
                            ? (p.src = p.src.replace("?autoplay=1&mute=1", ""))
                            : r.querySelector("video").pause());
                    });
                });
            }),
              l.add("(max-width: 1023px)", () => {
                y.set(c, { display: "none", opacity: 0 });
              });
          });
        return () => {
          o.revert();
        };
      }, []),
      N.useEffect(() => {
        const l = () => {
          s(window.innerWidth);
        };
        return (
          window.addEventListener("resize", l),
          () => {
            window.removeEventListener("resize", l);
          }
        );
      }, []),
      a.jsxs("article", {
        className: "work-item relative flex cursor-pointer group justify-end",
        onClick: e,
        children: [
          a.jsx("div", {
            className:
              "work-item__video lg:flex absolute top-0 -left-[35%] overflow-hidden lg:overflow-auto lg:w-[30%] max-h-[214px] h-[214px] rounded-[16px]",
            children:
              i > 1024
                ? t
                  ? a.jsx(ii, {
                      srcs: {
                        video:
                          W.VIDEO_FROM_MEDIA === t.type_of_video
                            ? t.media_preview_video
                            : t.preview_video,
                        youtube: t.preview_youtube_video,
                        image: t.preview_image,
                      },
                      type: t.type_of_video,
                    })
                  : a.jsx(pt.Single, {})
                : null,
          }),
          a.jsxs("div", {
            className:
              "work-item__info w-full h-auto flex flex-col lg:flex-row lg:justify-between lg:py-[32px] border-b border-black mb-[16px] lg:mb-0",
            children: [
              a.jsx("h3", {
                className:
                  "text-black-500 uppercase font-helvetica-bold text-[39px] leading-[48.75px] lg:text-[50px] lg:leading-[60px] lg:mr-[16px] group-hover:text-black-300 transition-all duration-300 ease-in-out",
                children: t.title,
              }),
              a.jsxs("div", {
                className: "mb-[9px] flex justify-between lg:mb-0 items-center",
                children: [
                  a.jsx("span", {
                    className:
                      "font-ibm-plex-mono font-normal text-black-500 text-[14px] leading-[24px] lg:text-[16px] lg:w-[150px] xl:w-[205px] lg:leading-[24px] lg:text-end group-hover:text-black-300 transition-all duration-300 ease-in-out text-balance",
                    children: t.subtitle,
                  }),
                  a.jsx("div", {
                    className: "lg:hidden",
                    children: a.jsx("svg", {
                      width: "32",
                      height: "32",
                      viewBox: "0 0 32 32",
                      fill: "none",
                      xmlns: "http://www.w3.org/2000/svg",
                      children: a.jsx("path", {
                        d: "M7 16.6651H24.7733M24.7733 16.6651L18.1083 10.0001M24.7733 16.6651L18.1083 23.3301",
                        stroke: "#141213",
                        strokeWidth: "2",
                        strokeLinecap: "round",
                        strokeLinejoin: "round",
                      }),
                    }),
                  }),
                ],
              }),
            ],
          }),
        ],
      })
    );
  };
Lt.Skeleton = function () {
  return a.jsx(Mt, {
    className: "inline-block min-w-[100%] md:min-w-[70%] h-[50px]",
  });
};
const si = ({ list: t, title: e, onSelectedItem: i }) => {
  const s = t.map((l) => l.work);
  return a.jsxs(a.Fragment, {
    children: [
      a.jsx("h2", {
        id: "work-title",
        className:
          "font-helvetica text-[31px] leading-[38.75px] lg:text-[48px] lg:leading-[60px] mb-[56px] lg:mb-[64px] min-w-max lg:min-w-fit",
        children: e,
      }),
      a.jsx("div", {
        className: "relative w-full",
        children: s.map((l, n) =>
          a.jsx(
            Lt,
            { item: l == null ? void 0 : l.acf, onClick: () => i(l) },
            `${l.ID}${n}`
          )
        ),
      }),
    ],
  });
};
function li({
  isWorkSectionActive: t,
  dataList: e,
  dataTitle: i,
  onSelectedItem: s,
}) {
  return (
    N.useLayoutEffect(() => {
      const l = y.context(() => {
        y.timeline().to(
          "#work-section",
          {
            scrollTrigger: {
              trigger: "#work-section",
              start: t ? "top top" : "50% top",
              end: t ? "top top" : "95% 5%",
              invalidateOnRefresh: !1,
              pin: !0,
              pinSpacing: !1,
            },
          },
          "a"
        );
      });
      return () => l.revert();
    }, [t]),
    a.jsxs("section", {
      id: "work-section",
      className: "pt-[150px]",
      children: [
        a.jsx(ut, {
          interiorBackground: "#ffffffff",
          containerBackground: "transparent",
          type: "light",
        }),
        a.jsx("section", {
          className:
            "bg-white w-full xl:flex pt-[200px] lg:pt-[130px] section-parallax xl:px-[23px] 2xl:px-[0px]",
          id: "work-section-inside",
          children: a.jsx("div", {
            className: "container mx-auto px-[23px] xl:px-0 flex justify-end",
            children: a.jsxs("div", {
              id: "work-container",
              className:
                "w-full lg:w-[70%] overflow-hidden lg:overflow-visible",
              children: [
                a.jsx(si, { list: e, title: i, onSelectedItem: s }),
                a.jsx("div", {
                  className: "mb-[50px] mt-[32px] lg:mt-[40px] lg:mb-[191px]",
                }),
              ],
            }),
          }),
        }),
      ],
    })
  );
}
const ni = ({ news: t }) => {
  const e = t.sort((i, s) => s.pinned - i.pinned);
  return a.jsx(At, {
    columnsCountBreakPoints: { 320: 1, 768: 2, 1024: 3 },
    children: a.jsx(Rt, {
      gutter: "21px",
      className: "feed-news",
      children: e
        .map((i) => i.news)
        .map((i, s) => {
          let l, n;
          return (
            s >= 3 && s <= 5 && (l = "text"),
            s === 4 && (n = "large"),
            a.jsx(
              Ft,
              {
                id: i.ID,
                url: i.acf.url,
                title: i.acf.title,
                date: i.post_date,
                description: i.acf.description,
                category: i.acf.category,
                image: i.acf.image,
                type: l,
                size: n,
              },
              i.ID
            )
          );
        }),
    }),
  });
};
function oi({ dataTitle: t, dataNews: e }) {
  return (
    N.useLayoutEffect(() => {
      const i = y.context(() => {
        y.timeline().to(
          "#news-section",
          {
            scrollTrigger: {
              trigger: "#news-section",
              start: "top top",
              end: "top top",
              invalidateOnRefresh: !1,
              pin: !0,
              pinSpacing: !1,
            },
          },
          "a"
        );
      });
      return () => i.revert();
    }, []),
    a.jsx("section", {
      className: "bg-gray",
      id: "news-section",
      children: a.jsxs("div", {
        className:
          "container mx-auto w-full px-[23px] pt-[92px] 2xl:px-0 lg:pt-[120px] lg:pb-[120px]",
        children: [
          a.jsx("h2", {
            className:
              "text-black-500 font-helvetica-extrabold text-[26px] min-[400px]:text-[31px] leading-[38.75px] mb-[56px] sm:mb-[32px] lg:text-[48px] lg:leading-[60px] uppercase",
            children: t,
          }),
          a.jsx("div", {
            className: "d-none sm:block md:mb-[64px]",
            children: a.jsx(Ae, {
              to: "/news",
              children: a.jsx(re, { children: "Ver todas las noticias" }),
            }),
          }),
          a.jsx(ni, { news: e }),
          a.jsx("div", {
            className: "d-none mt-[32px] pb-[96px] sm:hidden",
            children: a.jsx(Ae, {
              to: "/news",
              children: a.jsx(re, { children: "Ver todas las noticias" }),
            }),
          }),
        ],
      }),
    })
  );
}
const ri = ({ item: t, isOpen: e, onClose: i }) => {
  const s = N.useRef(null),
    l = N.useRef(null),
    [n, c] = N.useState(`${t.video}?autoplay=1`),
    [o, r] = N.useState(!1),
    d = `modal-container fixed top-0 left-0 w-full h-screen flex md:items-center justify-center visible bg-white/60 backdrop-blur-[7px] bg-opacity-70 z-[60] pointer-events-auto ${
      e ? "flex" : "hidden"
    }`,
    p = () => {
      const u = y.matchMedia();
      y.set(".modal-wrapper", {
        opacity: 0,
        xPercent: -99,
        yPercent: -50,
        scale: ".1",
      }),
        y.set("#btn-see-project", { opacity: 0 });
      const k = y.timeline({
        defaults: { ease: "elastic(1,.9)", delay: 0.2, duration: 1.4 },
      });
      k.to(
        ".modal-wrapper",
        { opacity: 1, xPercent: 0, yPercent: 0, scale: 1 },
        "initial"
      ),
        k.to("#btn-see-project", { opacity: 1 }, "final"),
        u.add("(min-width: 1023px)", () => {
          y.set(".modal-flip", { opacity: 1 });
          const m = y.timeline({
            defaults: { ease: "elastic.out(1, 0.3)", duration: 0.4 },
          });
          m.to(".modal-flip iframe", { scale: 1.4 }),
            m.to(".modal-flip iframe", { scale: 1 });
        });
    },
    h = () => {
      s.current.play(), c(`${t.video}?autoplay=0`);
    },
    b = () => {
      s.current.reverse(), c(`${t.video}?autoplay=1`);
    },
    x = (u) => {
      u.preventDefault(),
        u.stopPropagation(),
        o && s.current.reverse(),
        c(`${t.video}?autoplay=0`),
        i();
    };
  N.useLayoutEffect(() => {
    const u = y.context(() => {
      y.set(".modal-wrapper", { perspective: 1900 }),
        y.set(".modal-flip", { transformStyle: "preserve-3d" }),
        y.set(".modal-back", { rotationY: -180 }),
        y.set([".modal-front", ".modal-back"], {
          backfaceVisibility: "hidden",
        }),
        // Línea adicional para que el back aparezca primero
        y.set(".modal-flip", { rotationY: 180 });
      const k = y.timeline({ paused: !0, onComplete: () => r(!o) });
      k.to(".modal-flip", {
        duration: 1.2,
        ease: "power3.inOut",
        rotationY: -180,
      }),
        (s.current = k);
    });
    return () => u.revert();
  }, []),
    N.useEffect(() => {
      e && p(l.current);
    }, [e]);
  const f = ({ type: u, content: k }) =>
    u === W.IMAGE
      ? a.jsx("img", {
          src: k.image.url,
          alt: k.image.alt,
          className: "w-full h-full object-cover rounded-[24px]",
        })
      : a.jsx("iframe", {
          id: "modal-video",
          src: n,
          ref: l,
          title: "YouTube Video",
          className:
            "absolute top-0 left-0 w-full h-full z-[1] rounded-[24px] ",
          allow: "accelerometer; autoplay; clipboard-write; encrypted-media;",
          allowFullScreen: !0,
        });
  return Tt.createPortal(
    a.jsx("div", {
      className: d,
      children: a.jsx("div", {
        className:
          "modal-wrapper w-[90%] h-[90vh] h-[90dvh] lg:w-[90%] lg:max-w-[1328px] lg:max-h-[656px] lg:h-[80dvh] mt-[20px] lg:-mt-[45px]",
        children: a.jsxs("div", {
          className:
            "modal-flip shadow-modal bg-white h-[80vh] h-[80dvh] lg:h-full relative outline-none rounded-[24px]",
          children: [
            a.jsxs("div", {
              id: "modal-front",
              className:
                "modal-front rounded-[24px] absolute left-0 top-0 w-full h-full z-[2]",
              children: [
                a.jsx("div", {
                  className: "absolute top-[24px] right-[24px] z-10",
                  children: a.jsx("button", {
                    onClick: x,
                    className:
                      "bg-black-500 text-white w-[45px] h-[45px] rounded-fill grid place-content-center rounded-full group hover:bg-[#4D4147] transition-all duration-200 ease-in-out",
                    children: a.jsxs("svg", {
                      width: "24",
                      height: "22",
                      viewBox: "0 0 24 22",
                      fill: "none",
                      xmlns: "http://www.w3.org/2000/svg",
                      className: "fill-white ",
                      children: [
                        a.jsx("rect", {
                          width: "24.9931",
                          height: "2.08275",
                          rx: "0.5",
                          transform:
                            "matrix(0.679011 0.734128 -0.679011 0.734128 4.2218 1.14542)",
                        }),
                        a.jsx("rect", {
                          width: "24.9931",
                          height: "2.08275",
                          rx: "0.5",
                          transform:
                            "matrix(0.679011 -0.734128 0.679011 0.734128 2.80762 19.4935)",
                        }),
                      ],
                    }),
                  }),
                }),
                t &&
                  a.jsx(f, {
                    type: t.type_of_content,
                    content: { video: t.video, image: t.content_image },
                  }),
                a.jsx("div", {
                  className:
                    "absolute -bottom-[64px] z-20 w-full right-0  lg:w-auto lg:right-[32px] ",
                  id: "btn-see-project",
                  children: a.jsx(re, {
                    onClick: h,
                    className: "w-full lg:w-auto",
                    children: "Ver detalles del proyecto",
                  }),
                }),
              ],
            }),
            a.jsxs("div", {
              id: "modal-back",
              className:
                "h-[82vh] h-[82dvh] modal-back flex flex-col lg:flex-row absolute left-0 top-0 w-full sm:h-full z-[13] pointer-events-auto",
              children: [
                a.jsx("div", {
                  className:
                    "absolute top-[24px] right-[24px] z-[16] pointer-events-auto",
                  children: a.jsx("button", {
                    onClick: x,
                    className:
                      "bg-black-500 text-white w-[45px] h-[45px] rounded-fill grid place-content-center rounded-full group hover:bg-[#4D4147] transition-all duration-200 ease-in-out z-[16]",
                    children: a.jsxs("svg", {
                      width: "24",
                      height: "22",
                      viewBox: "0 0 24 22",
                      fill: "none",
                      xmlns: "http://www.w3.org/2000/svg",
                      className: "fill-white ",
                      children: [
                        a.jsx("rect", {
                          width: "24.9931",
                          height: "2.08275",
                          rx: "0.5",
                          transform:
                            "matrix(0.679011 0.734128 -0.679011 0.734128 4.2218 1.14542)",
                        }),
                        a.jsx("rect", {
                          width: "24.9931",
                          height: "2.08275",
                          rx: "0.5",
                          transform:
                            "matrix(0.679011 -0.734128 0.679011 0.734128 2.80762 19.4935)",
                        }),
                      ],
                    }),
                  }),
                }),
                a.jsx("div", {
                  className:
                    "w-full lg:w-[50%] h-[276px] lg:h-full z-[12] pointer-events-none",
                  children: (t.images || [t.image]).map((img) =>
                    a.jsx("img", {
                      src: img.url,
                      alt: img.alt,
                      className:
                        "w-full h-full object-cover rounded-t-[24px] lg:rounded-l-[24px] lg:rounded-r-none carousel-img",
                    })
                  ),
                }),
                a.jsx("div", {
                  className:
                    "h-[calc(82vh-286px)] h-[calc(82dvh-286px)] lg:w-[50%] lg:h-full px-[25px] pt-[16px] pb-[24px] lg:py-[42px] lg:pl-[52px] lg:pr-[10px] z-[14] pointer-events-auto",
                  children: a.jsxs("div", {
                    className:
                      "modal-back-description w-[106%] h-[97%] sm:w-full pr-[10px] min-[400px]:pr-[20px] lg:pr-[30px] lg:w-auto sm:h-full overflow-y-scroll lg:overflow-auto",
                    children: [
                      a.jsx("h2", {
                        className:
                          "font-helvetica-extrabold text-[39px] leading-[48.75px] lg:text-[61px] lg:mb-[8px] lg:leading-[76.25px]",
                        children: t.title,
                      }),
                      a.jsx("h3", {
                        className:
                          "text-black-400 font-ibm-plex-mono text-[20px] leading-[25px] lg:text-[36px] lg:leading-[48.75px] mb-[8px] line-clamp-2",
                        children: t.subtitle,
                      }),
                      a.jsx("p", {
                        className:
                          "font-ibm-plex-mono font-normal text-[16px] leading-[24px] mb-[32px] md:mb-0",
                        children: t.description,
                      }),
                      a.jsx("div", {
                        className: "d-none lg:flex mt-[32px]",
                        children: a.jsx(re, {
                          onClick: b,
                          children: "Reproducir Video",
                        }),
                      }),
                    ],
                  }),
                }),
                a.jsx("div", {
                  className:
                    "absolute -bottom-[48px] z-20 w-full right-0 lg:w-auto lg:right-[32px] lg:hidden",
                  id: "btn-see-project",
                  children: a.jsx(re, {
                    onClick: b,
                    className: "d-none w-full lg:w-auto",
                    children: "Reproducir Video",
                  }),
                }),
              ],
            }),
          ],
        }),
      }),
    }),
    document.getElementById("modal")
  );
};
function ui() {
  const [t, e, i] = Ot("json", 5), // anterior ->  Ot("pages", 5),
    [s, l] = N.useState({}),
    [n, c] = N.useState(!1),
    [o, r] = N.useState(!1),
    [d, p] = N.useState(!1),
    [h, b] = N.useState(!0),
    x = document.getElementsByTagName("body")[0];
  y.registerPlugin(ht, ie);
  let f = "";
  t &&
    (t.acf.isShowDescriptionSection && (f = "ShortDescriptionSection"),
    t.acf.isShowWorks && (f = "WorkSection"),
    t.acf.isShowNews && (f = "NewsSection")),
    N.useEffect(() => {
      const m = new Promise((v) => {
        setTimeout(() => {
          v();
        }, 3e3);
      });
      return (
        Promise.all([e, m]).then(() => {
          b(!1);
        }),
        () => clearTimeout(m)
      );
    }, [e]),
    N.useEffect(() => {
      f === "WorkSection" && p(!0), f === "ShortDescriptionSection" && r(!0);
    }, [f]);
  const u = (m) => {
      l(m), c(!0);
    },
    k = () => {
      c(!1);
    };
  return (
    N.useLayoutEffect(
      () => (
        n && x.classList.add("overflow-hidden"),
        () => {
          x.classList.remove("overflow-hidden");
        }
      ),
      [n]
    ),
    h
      ? a.jsx(pt, {})
      : i
      ? a.jsx("div", { children: Dt.pages.label })
      : t &&
        a.jsx(Vt, {
          title: t.acf.seo.title ? t.acf.seo.title : "Home",
          description: t.acf.seo.description ? t.acf.seo.description : "",
          canonicalURL: window.location.href,
          thumbnail: t.acf.seo.thumbnail ? t.acf.seo.thumbnail : It,
          className: "HomePage",
          children: a.jsxs(ei, {
            children: [
              a.jsx("section", {
                id: "video-section",
                children: a.jsx(Qt, {
                  urls: t.acf.banner_section,
                  type: t.acf.banner_section.type_of_video,
                }),
              }),
              t.acf.isShowDescriptionSection &&
                a.jsx(ti, { isShortDescriptionActive: o, data: t.acf }),
              n && a.jsx(ri, { isOpen: n, onClose: k, item: s.acf }),
              t.acf.isShowWorks &&
                a.jsx(li, {
                  isWorkSectionActive: d,
                  dataList: t.acf.works,
                  dataTitle: t.acf.work_title,
                  onSelectedItem: u,
                }),
              t.acf.isShowNews &&
                a.jsx(oi, {
                  dataTitle: t.acf.news_title,
                  dataNews: t.acf.news,
                }),
            ],
          }),
        })
  );
}
export { ui as default };
