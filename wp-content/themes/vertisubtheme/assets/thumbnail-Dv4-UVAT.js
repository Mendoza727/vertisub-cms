import { r as t, j as e } from "./index-5_OOGiqd.js";
import {
  h,
  H as m,
  r as i,
  F as _,
  i as p,
  b as x,
} from "./SmootherLayout-DPjoTzjc.js";
const b = ({
    title: s,
    description: a,
    children: o,
    thumbnail: n,
    canonicalURL: c,
    type: l,
    className: u = "",
  }) => {
    const [r, d] = t.useState(null);
    return (
      t.useEffect(() => {
        (async () => {
          const f = await p("options/options");
          d(f);
        })();
      }, []),
      e.jsxs(e.Fragment, {
        children: [
          e.jsx(h, {
            title: s,
            description: a,
            thumbnail: n,
            canonicalURL: c,
            type: l,
          }),
          e.jsxs("main", {
            className: `scroll-smooth -mt-[87px] lg:-mt-[85px] ${u}`,
            children: [
              e.jsx(m, { routes: i, data: r }),
              o,
              e.jsx(_, { routes: i, data: r }),
            ],
          }),
        ],
      })
    );
  },
  y = (s) => {
    const [a, o] = t.useState(window.innerWidth <= 640);
    return (
      t.useEffect(() => {
        const n = () => {
          o(window.innerWidth <= 640);
        };
        return (
          window.addEventListener("resize", n),
          () => {
            window.removeEventListener("resize", n);
          }
        );
      }, []),
      a ? e.jsx(b, { ...s }) : e.jsx(x, { ...s })
    );
  },
  E = "/thumbnail.png";
export { y as L, E as d };
