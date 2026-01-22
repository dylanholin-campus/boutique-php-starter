# MaBoutique - Starter PHP

Starter HTML/CSS pour la formation PHP 14 jours. Template statique à "PHPiser" progressivement.

## Installation

1. **Forker** ce repo (bouton "Fork" en haut à droite sur GitHub)
2. Cloner votre fork :
```bash
git clone https://github.com/VOTRE-USERNAME/boutique-php-starter.git
```

## Structure

```
public/          # Pages HTML (index, catalogue, produit, panier, auth, contact)
public/css/      # Styles CSS
app/             # Code PHP (à créer)
views/           # Templates (à créer)
config/          # database.sql
exercices/       # Exercices jour 1-14
```

## Principe

Chaque fichier HTML contient des commentaires `<!-- JOUR X : ... -->` indiquant quoi modifier et quand.

Exemple :
```html
<!-- JOUR 1 : Remplacer 2024 par <?= date('Y') ?> -->
<!-- JOUR 3 : Générer avec foreach -->
<!-- JOUR 7 : Formulaire POST ajout panier -->
```

## Base de données (Jour 7+)
Si vous n'arrivez pas a créer votre base de données, vous pouvez :
```bash
mysql -u root -p < config/database.sql
```

## Tableau comparatif : Copilot vs PHPStan vs Rector vs Pint

### 🎯 Vue d'ensemble

| Outil | Fonction principale | Automatisable | Type d'entrée |
|-------|-------------------|:-------------:|---------------|
| **Copilot** | Suggestions IA intelligentes | ❌ Non | Questions, contexte |
| **PHPStan** | Analyse statique & détection d'erreurs | ✅ Oui | Code source |
| **Rector** | Refactorisation & modernisation auto | ✅ Oui | Code source |
| **Pint** | Formatage & style de code | ✅ Oui | Code source |

### 📊 Comparaison détaillée

#### Détection & Correction
- **Copilot** : Détecte les erreurs logiques, propose des solutions contextuelles
- **PHPStan** : Détecte les erreurs de typage, variables non définies, erreurs statiques
- **Rector** : Corrige automatiquement les patterns de code obsolètes
- **Pint** : Corrige le style et la formatage (indentation, espaces, etc.)

#### Exécution
- **Copilot** : Manuel (demandes utilisateur)
- **PHPStan** : `phpstan analyse` - rapide
- **Rector** : `rector process` - rapide avec aperçu avant application
- **Pint** : `pint` - très rapide

#### Fiabilité
- **Copilot** : ⚠️ Peut inventer du code (hallucinations)
- **PHPStan** : ✅ 100% déterministe et fiable
- **Rector** : ✅ 100% automatique et testable
- **Pint** : ✅ 100% cohérent avec PSR-12

### 🚀 Quand utiliser quoi ?

```
✏️ En développement → Copilot (idées, suggestions, explications)
🔍 Avant commit → PHPStan (vérifier la qualité du code)
🔧 Modernisation → Rector (mettre à jour le code)
🎨 Format final → Pint (uniformiser le style)
```