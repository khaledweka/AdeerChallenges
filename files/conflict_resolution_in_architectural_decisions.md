## Conflict Resolution in Architectural Decisions

### Context:

- Present a scenario where there's a division in the team over the choice of a
  specific technology for a component of the system.
- Detail your conflict resolution approach, taking into account the technical merits
  and the team's concerns, leading to a consensus-driven decision

### Scenario:

**Choosing a Database for the Property Service**

#### The team is developing the Property Service for Application bidding platform. There's a disagreement about theappropriate database technology:

- **Team A:** Proposes a relational database (SQL) like MySQL. They highlight its strengths:
  Structured data: Property details naturally fit a relational schema.
  ACID compliance: Ensures data integrity for critical auction data.
  Familiarity: Most team members have experience with SQL databases.
- **Team B:** Advocates for a NoSQL database like MongoDB. They emphasize its advantages:
  Flexibility: Can accommodate future schema changes and potentially handle unstructured data (e.g., property images).
  Scalability: Easier to scale horizontally for high-volume property listings.
  Performance benefits: Potentially faster read/write operations for frequently accessed data.

### Conflict Resolution Approach:

- **Facilitate Open Discussion**:

  Organize a team meeting to discuss the merits of each option.
  Encourage both sides to present their arguments and address concerns raised by the other team.
  Clarify team concerns with the proposed technologies (e.g., learning curve for NoSQL, potential complexity of managing
  eventual consistency).

- **Technical Merit Evaluation**:

    - Analyze the specific needs of the Property Service:
        - Data structure: How well does each option handle the expected data model (structured vs. potentially
          unstructured elements)?
            - Data volume and access patterns: How much data is anticipated, and what are the expected read/write
              frequencies?
                - Scalability needs: Can the chosen technology scale efficiently with the platform's growth?
    - Research and compare relevant benchmarks and performance metrics for both options.

- **Prototyping (Optional)**:

    - If time and resources permit, consider building lightweight prototypes using both options. This can provide
      practical experience and offer a tangible basis for comparison.

- **Decision-Making**:

    - Based on the discussion, technical merits, and potential trade-offs, guide the team towards a consensus decision.
      Document the decision, rationale, and any considerations for future revisions if needed.

### **Leading to Consensus**:

By facilitating an open and informed discussion, the team can arrive at a decision based on factual analysis and a clear
understanding of both options.

Consensus building is key, but it's also important to acknowledge the potential need for
compromise:

- If the team leans toward SQL but acknowledges potential scalability concerns, consider implementing schema design
  patterns that optimize horizontal scaling in the future.
- If NoSQL is chosen, address team concerns by providing training and resources to help them become proficient with the
  new technology.