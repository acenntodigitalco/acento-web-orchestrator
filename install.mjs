#!/usr/bin/env node
/**
 * Acento Web Orchestrator — Instalador multiplataforma (Windows / macOS / Linux)
 * Creado por Acento Digital by Elkin De Ávila
 * Sin dependencias externas (Node.js >= 18).
 */

import fs from "node:fs";
import path from "node:path";
import readline from "node:readline/promises";
import { stdin as input, stdout as output } from "node:process";
import { fileURLToPath } from "node:url";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const ALL_SKILLS = [
  "master-ux-ui",
  "master-seo-tecnico",
  "master-copywriting",
  "master-cro",
  "master-tracking",
  "master-animaciones",
  "master-astro-dev",
  "master-wp-custom",
  "master-woocommerce",
  "master-bootstrap-5"
];

const PROFILES = {
  landing: {
    label: "Landing / Sitio HTML5 + CSS3 + GSAP (Conversión & Meta Ads)",
    skills: [
      "master-ux-ui",
      "master-seo-tecnico",
      "master-copywriting",
      "master-cro",
      "master-tracking",
      "master-animaciones"
    ]
  },
  astro: {
    label: "Proyecto Astro 5/6 + TypeScript + Tailwind v4 / CSS nativo",
    skills: [
      "master-ux-ui",
      "master-seo-tecnico",
      "master-astro-dev",
      "master-copywriting",
      "master-cro",
      "master-tracking",
      "master-animaciones"
    ]
  },
  wordpress: {
    label: "WordPress Custom (Block Theme, Plugins, ACF, Headless WP)",
    skills: [
      "master-ux-ui",
      "master-seo-tecnico",
      "master-wp-custom",
      "master-copywriting",
      "master-cro",
      "master-tracking"
    ]
  },
  woocommerce: {
    label: "WordPress + WooCommerce (HPOS, Blocks, SEO E-commerce, Tracking)",
    skills: [
      "master-ux-ui",
      "master-seo-tecnico",
      "master-wp-custom",
      "master-woocommerce",
      "master-cro",
      "master-tracking"
    ]
  },
  bootstrap: {
    label: "Proyecto con Bootstrap 5.3 (sin Tailwind)",
    skills: [
      "master-ux-ui",
      "master-seo-tecnico",
      "master-bootstrap-5",
      "master-copywriting",
      "master-cro",
      "master-tracking"
    ]
  }
};

function printBanner() {
  console.log("");
  console.log("==============================================================");
  console.log("   ACENTO WEB ORCHESTRATOR — Kit de Agentes y Master Skills   ");
  console.log("   Acento Digital by Elkin De Ávila                           ");
  console.log("==============================================================");
  console.log("");
}

function printHelp() {
  printBanner();
  console.log("Uso interactivo:");
  console.log("  node install.mjs");
  console.log("");
  console.log("Uso directo por flags (sin preguntas):");
  console.log("  node install.mjs --mode=full --target=./mi-orquestador");
  console.log("  node install.mjs --mode=profile --profile=astro --target=./mi-proyecto");
  console.log("");
  console.log("Perfiles disponibles (--profile):");
  for (const [key, cfg] of Object.entries(PROFILES)) {
    console.log(`  - ${key.padEnd(12)} ${cfg.label}`);
  }
  console.log("");
}

function parseArgs(argv) {
  const args = {};
  for (const item of argv) {
    if (item === "--help" || item === "-h") args.help = true;
    else if (item.startsWith("--mode=")) args.mode = item.slice(7).trim();
    else if (item.startsWith("--profile=")) args.profile = item.slice(10).trim();
    else if (item.startsWith("--target=")) args.target = item.slice(9).trim();
  }
  return args;
}

function copyRecursive(src, dest) {
  if (!fs.existsSync(src)) {
    throw new Error(`No se encontró la ruta de origen: ${src}`);
  }
  fs.mkdirSync(path.dirname(dest), { recursive: true });
  fs.cpSync(src, dest, { recursive: true, force: true });
}

function installFull(targetDir) {
  fs.mkdirSync(targetDir, { recursive: true });

  const items = [
    "AGENTS.md",
    ".agents",
    "_templates",
    "_prompts",
    "master-skills"
  ];

  for (const item of items) {
    copyRecursive(path.join(__dirname, item), path.join(targetDir, item));
  }

  console.log(`\n✓ Kit completo instalado en: ${targetDir}`);
  console.log("  Incluye: AGENTS.md, 5 agentes, 2 workflows, plantillas y 10 master skills.");
  console.log("\nSiguientes pasos:");
  console.log(`  1. Abre "${targetDir}" como workspace en Antigravity (u otro agente compatible).`);
  console.log("  2. Ejecuta /quiero-iniciar-proyecto para arrancar tu primer proyecto web.");
}

function installProfile(targetDir, profileKey) {
  const profile = PROFILES[profileKey];
  if (!profile) {
    throw new Error(`Perfil desconocido: "${profileKey}". Usa: ${Object.keys(PROFILES).join(", ")}`);
  }

  const skillsDest = path.join(targetDir, ".agents", "skills");
  fs.mkdirSync(skillsDest, { recursive: true });

  for (const skill of profile.skills) {
    copyRecursive(
      path.join(__dirname, "master-skills", skill),
      path.join(skillsDest, skill)
    );
  }

  console.log(`\n✓ Perfil "${profileKey}" instalado en: ${skillsDest}`);
  console.log(`  Skills copiadas (${profile.skills.length}): ${profile.skills.join(", ")}`);
  console.log("\nSiguiente paso:");
  console.log(`  Abre "${targetDir}" en tu agente; las master skills quedarán activas automáticamente.`);
}

async function main() {
  const args = parseArgs(process.argv.slice(2));
  if (args.help) {
    printHelp();
    return;
  }

  printBanner();

  if (args.mode && args.target) {
    const absTarget = path.resolve(args.target);
    if (args.mode === "full") {
      installFull(absTarget);
      return;
    }
    if (args.mode === "profile") {
      installProfile(absTarget, args.profile || "landing");
      return;
    }
    throw new Error(`Modo inválido: ${args.mode}. Usa "full" o "profile".`);
  }

  const rl = readline.createInterface({ input, output });
  try {
    console.log("Elige el modo de instalación:");
    console.log("  1) Kit completo (Recomendado) — Orquestador + 4 subagentes + workflows + plantillas + 10 master skills");
    console.log("  2) Por perfil de stack        — Copia solo las master skills necesarias a un proyecto existente");
    console.log("");

    const modeAnswer = (await rl.question("Opción [1/2] (por defecto 1): ")).trim() || "1";

    if (modeAnswer === "1") {
      const defaultDest = path.resolve(process.cwd(), "acento-web-orchestrator");
      const targetAnswer = (await rl.question(`Carpeta destino [${defaultDest}]: `)).trim();
      installFull(path.resolve(targetAnswer || defaultDest));
    } else if (modeAnswer === "2") {
      console.log("\nPerfiles disponibles:");
      const keys = Object.keys(PROFILES);
      keys.forEach((k, idx) => {
        console.log(`  ${idx + 1}) ${k.padEnd(12)} — ${PROFILES[k].label}`);
      });
      const profAnswer = (await rl.question("\nElige perfil [1-5] (por defecto 1): ")).trim() || "1";
      const idx = Number(profAnswer) - 1;
      const chosenKey = keys[idx] || (PROFILES[profAnswer] ? profAnswer : "landing");
      const targetAnswer = (await rl.question(`Carpeta de tu proyecto [${process.cwd()}]: `)).trim();
      installProfile(path.resolve(targetAnswer || process.cwd()), chosenKey);
    } else {
      console.log("Opción no válida. Ejecuta nuevamente `node install.mjs`.");
      process.exitCode = 1;
    }
  } finally {
    rl.close();
  }
}

main().catch((err) => {
  console.error("\nError durante la instalación:", err.message);
  process.exit(1);
});
