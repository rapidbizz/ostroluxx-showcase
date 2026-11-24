// Demo example — a small product filter in plain JavaScript.
// Illustrative example only, not the client website code.

const PRODUCTS = [
  { name: "Elantra Wall Lamp", type: "wall" },
  { name: "Elantra Ceiling Light", type: "ceiling" },
  { name: "Elantra Floor Lamp", type: "floor" },
];

function filterProducts(type) {
  return type === "all" ? PRODUCTS : PRODUCTS.filter((p) => p.type === type);
}

module.exports = { filterProducts };
