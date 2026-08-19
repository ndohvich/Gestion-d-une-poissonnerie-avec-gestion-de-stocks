from io import BytesIO
from reportlab.lib import colors
from reportlab.lib.pagesizes import A4
from reportlab.lib.styles import getSampleStyleSheet
from reportlab.platypus import SimpleDocTemplate, Paragraph, Spacer, Table, TableStyle

def build_pdf(user, todos) -> bytes:
    # Génère un PDF premium, groupé par statut, sans écrire de fichier temporaire.
    buffer = BytesIO(); doc = SimpleDocTemplate(buffer, pagesize=A4, title="Export Todolist")
    styles = getSampleStyleSheet(); story = [Paragraph("TodolistApp · Export", styles["Title"]), Paragraph(f"Utilisateur: {user.username} ({user.email})", styles["Normal"]), Spacer(1, 16)]
    for label, done in [("À faire", False), ("Terminées", True)]:
        rows = [["Titre", "Priorité", "Échéance", "Tags"]]
        rows += [[t.title, t.priority, t.due_date or "—", t.tags or "—"] for t in todos if t.completed is done]
        story += [Paragraph(label, styles["Heading2"]), Table(rows, repeatRows=1, style=TableStyle([("BACKGROUND",(0,0),(-1,0), colors.HexColor("#7C3AED")),("TEXTCOLOR",(0,0),(-1,0), colors.white),("GRID",(0,0),(-1,-1), .35, colors.HexColor("#DDDDDD")),("ROWBACKGROUNDS",(0,1),(-1,-1), [colors.HexColor("#F7F4FF"), colors.white])])), Spacer(1, 14)]
    doc.build(story); return buffer.getvalue()
